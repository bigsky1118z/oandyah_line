<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LineApiRichmenuController extends Controller
{
    public function index($channel_name)
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        if($channel){
            $data   =   array(
                "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            );
            $headers = array(
                'Authorization'     =>  'Bearer ' . $channel->access_token,
            );
            // デフォルトリッチメニュー
            $default_richmenu_id    =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/user/all/richmenu");
            if($default_richmenu_id->successful()){
                $data["default_richmenu_id"]    =   $default_richmenu_id["richMenuId"];
            }
            // リッチメニューリスト
            $richmenu_list  =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/richmenu/list");
            if($richmenu_list->successful()){
                $data["richmenu_list"]  =   $richmenu_list["richmenus"];
            }
            return view('admin.api.line.richmenu.index', $data);
        } else {
            return back();
        }

    }
    public function create($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view('admin.api.line.richmenu.create', $data);
    }

    public function store(Request $request, $channel_name)
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        if($channel){
            $headers    =   array(
                "Authorization" =>  "Bearer " . $channel->access_token,
                "Content-Type"  =>  "application/json",
            );
            $body   =   array(
                "size"          =>  $request->get("size"),
                "selected"      =>  $request->get("selected"),
                "name"          =>  $request->get("name"),
                "chatBarText"   =>  $request->get("chatBarText"),
                "areas"         =>  array(),
            );
            foreach($request->get("areas") as $area){
                if(isset($area["bounds"]["x"]) && isset($area["bounds"]["y"]) && isset($area["bounds"]["width"]) && isset($area["bounds"]["height"]) && isset($area["action"]["type"])){
                    $body["areas"][]    =   $area;
                }
            }
            $richmenu   =   Http::withHeaders($headers)->post("https://api.line.me/v2/bot/richmenu", $body);
            if($richmenu->successful()){
                $richmenu_id    =   $richmenu["richMenuId"];

                if($request->hasFile('image')){
                    $richmenu_image =   $request->file("image");
                    $image_headers  =   array(
                        "Authorization" =>  "Bearer " . $channel->access_token,
                    );
                    $richmenu_upload_image  =   Http::withHeaders($image_headers)->withBody(file_get_contents($richmenu_image->getRealPath()),$richmenu_image->getMimeType())->post("https://api-data.line.me/v2/bot/richmenu/$richmenu_id/content");
                    if($richmenu_upload_image->successful()){
                        return redirect("/api/line/$channel_name/richmenu");
                    } else {
                        $delete_headers =   array(
                            'Authorization'     =>  'Bearer ' . $channel->access_token,
                        );
                        Http::withHeaders($delete_headers)->delete("https://api.line.me/v2/bot/richmenu/$richmenu_id");
                        return back();
                    }
                }else{
                    $delete_headers =   array(
                        'Authorization'     =>  'Bearer ' . $channel->access_token,
                    );
                    Http::withHeaders($delete_headers)->delete("https://api.line.me/v2/bot/richmenu/$richmenu_id");
                    return back();
            }
            } else {
                back();
            }
        } else {
            return back();
        }
    }

    public function show($channel_name, $richmenu_id)
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        if($channel){
            $data   =   array(
                "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            );
            $headers    =   array(
                'Authorization'     =>  'Bearer ' . $channel->access_token,
            );
            $richmenu   =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/richmenu/$richmenu_id");
            if($richmenu->successful()){
                $data["richmenu"]   =   $richmenu->json();
            }
            $richmenu_image =   Http::withHeaders($headers)->get("https://api-data.line.me/v2/bot/richmenu/$richmenu_id/content");
            if($richmenu_image->successful()){
                $image_data     =   $richmenu_image->body();
                $content_type   =   $richmenu_image->header("Content-Type");
                $image_url      =   "data:" . $content_type . ";base64," . base64_encode($image_data);
                $data["richmenu_image_url"]   =   $image_url;
            }
            return view('admin.api.line.richmenu.show', $data);
        }
        return back();
    }

    public function default($channel_name, $richmenu_id)
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        if($channel){
            $headers = array(
                'Authorization'     =>  'Bearer ' . $channel->access_token,
            );
            $default_richmenu_id    =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/user/all/richmenu");
            if($default_richmenu_id->successful() && $richmenu_id == $default_richmenu_id["richMenuId"]){
                $response   =   Http::withHeaders($headers)->delete("https://api.line.me/v2/bot/user/all/richmenu");
            } else {
                $response   =   Http::withHeaders($headers)->post("https://api.line.me/v2/bot/user/all/richmenu/$richmenu_id");
            }

            if($response->successful()){
                return redirect("/api/line/{{ $channel_name }}/richmenu");
            }else{
                return back();
            }
        }
        return back();
    }

    
    public function delete($channel_name, $richmenu_id)
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        if($channel){
            $headers = array(
                'Authorization'     =>  'Bearer ' . $channel->access_token,
            );
            $endpoint   =   "https://api.line.me/v2/bot/richmenu/$richmenu_id";
            $response   =   Http::withHeaders($headers)->delete($endpoint);
            if($response->successful()){
                return redirect("/api/line/$channel_name/richmenu");
            }else{
                return back();
            }
        }
        return back();
    }
}
