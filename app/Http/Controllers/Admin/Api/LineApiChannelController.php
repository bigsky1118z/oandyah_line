<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiMessage;
use App\Services\Api\LineApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LineApiChannelController extends Controller
{
    protected $line_api_service;

    public function __construct(LineApiService $line_api_service)
    {
        $this->line_api_service    =   $line_api_service;
    }

    public function index($channel_name)
    {
        $data   =   array(
            "channel"       =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view('admin.api.line.channel.index', $data);
    }

    public function info($channel_name)
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        $channel->update_info();
        return redirect("/api/line/$channel_name");
    }
    
    /** GET /api/line/create */
    public function create()
    {
        return view('admin.api.line.channel_create');
    }

    /** POST /api/line/create */
    public function store (Request $request)
    {
        $channel_name   =   $request->channel_name;
        $access_token   =   $request->access_token;
        if(LineApiChannel::where("channel_name",$channel_name)->orWhere("access_token",$access_token)->exists()){
            return back()->withInput();
        }elseif(is_null($channel_name) || is_null($access_token) || in_array($channel_name,array("all","create"))){
            return back()->withInput();
        } else {
            $info_headers = array(
                'Authorization' => 'Bearer '. $access_token,
            );
            $info = Http::withHeaders($info_headers)->get("https://api.line.me/v2/bot/info");
            if($info->successful()){
                $endpoint_headers = array(
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer '. $access_token,
                );
                $payload = array(
                    'endpoint'    => "https://oandyah.com/api/line/". $channel_name,
                );
                Http::withHeaders($endpoint_headers)->put("https://api.line.me/v2/bot/channel/webhook/endpoint", $payload);
                
                $channel    =   new LineApiChannel(array(
                    "channel_name"          =>  $channel_name,
                    "access_token"          =>  $access_token,
                    "line_user_id"          =>  isset($info['userId']) ? $info['userId'] : null,
                    "channel_display_name"  =>  isset($info['displayName']) ? $info['displayName'] : null,
                    "basic_id"              =>  isset($info['basicId']) ? $info['basicId'] : null,
                    "premium_id"            =>  isset($info['premiumId']) ? $info['premiumId'] : null,
                    "picture_url"           =>  isset($info['pictureUrl']) ? $info['pictureUrl'] : null,
                    "chat_mode"             =>  isset($info['chatMode']) ? $info['chatMode'] : null,
                    "mark_as_read_mode"     =>  isset($info['markAsReadMode']) ? $info['markAsReadMode'] : null,                    
                ));
                $channel->save();
                $channel->create_defaults();
                return redirect("api/line/$channel_name");
            } else {
                return back()->withInput();
            }
        
        }
    }
}
