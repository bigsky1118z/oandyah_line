<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Models\Line\Line;
use App\Models\Line\LineMessage;
use App\Models\Line\Message\LineMessageObject;
use App\Models\Line\Message\LineMessageText;
use Illuminate\Http\Request;

class LineMessageController extends Controller
{
    public function index($line_name)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return redirect("/line");
        }
        $data   =   array(
            "line"  =>  $line,
        );
        return view("line.message.index", $data);
    }

    public function sending($line_name, $message_id = null){
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return redirect("/line");
        }
        $message    =   LineMessage::whereLineId($line->id)->whereId($message_id)->first();
        $response   =   $message->sending();
        return redirect("/line/$line_name/message");
    }


    public function create($line_name, $message_id = null)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return redirect("/line");
        }
        $data   =   array(
            "line"  =>  $line,
        );
        $message    =   LineMessage::whereId($message_id)->whereLineId($line->id)->first();
        if($message){
            $data["message"]    =   $message;
        }
        return view("line.message.create", $data);
    }

    public function store(Request $request, $line_name, $line_message_id = null)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return redirect("/line");
        }
        if(LineMessage::whereLineId($line->id)->whereId($line_message_id)->whereStatus("sent")->exists()){
            return redirect("/line/$line_name/message");
        }
        $message    =   LineMessage::updateOrCreate(array(
            "id"                        =>  $line_message_id,
            "line_id"                   =>  $line->id,
        ),array(
            "type"                      =>  $request->input("type"),
            "notification_disabled"     =>  $request->input("notification") == "notification_disabled",
            "custom_aggregation_units"  =>  "message_" . date("YmdHis"),
            "line_user_id"              =>  $request->input("to.0"),
            "line_user_ids"             =>  $request->input("to"),
            "recipient"                 =>  $request->input("recipient"),
            "filter"                    =>  $request->input("filter"),
            "limit"                     =>  $request->input("limit"),
            "status"                    =>  "draft",
        ));
        $message_objects    =   $request->input("message_object");
        for($i=1; $i<=5; $i++){
            $type   =   isset($message_objects[$i]["type"]) ?   $message_objects[$i]["type"]    : null;
            $id     =   isset($message_objects[$i]["id"])   ?   $message_objects[$i]["id"]      : null;
            $message->set_message_object_by_id($i, $type, $id);
        }
        if($request->input("submit") == "送信"){
            $response   =   $message->sending();
        }
        if($request->input("submit") == "下書き保存"){
        }
        return redirect("/line/$line_name/message");
    }

    public function delete($line_name, $line_message_id)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return redirect("/line");
        }
        LineMessage::whereLineId($line->id)->whereId($line_message_id)->where("status", "!=","sent")->delete();
        return redirect("/line/$line_name/message");
    }

    public function iframe(Request $request, $line_name, $iframe, $message_id = null)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return redirect("/line");
        }
        $data   =   array(
            "line"      =>  $line,
            "message"   =>  $line->message($message_id)->first(),
            "query"     =>  $request->query(),
        );
        if(file_exists(resource_path("views/line/message/iframe/$iframe.blade.php"))){
            return view("line.message.iframe.$iframe", $data);
        } else {
            return redirect("/line");
        }
    }

    public function store_message_object(Request $request, $line_name, $iframe, $id = null)
    {        
        $user   =   auth()->user();
        if(!$user){
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return response()->json(['error' => 'Line not found.'], 404);
        }
        $data   =   array();
        switch($iframe){
            case("message"):
                $value  =   null;
                $type   =   $request->input("type");
                $name   =   $request->input("name","once");
                $data["type"]   =   $type;
                $data["name"]   =   $name;
                switch($type){
                    case("text"):
                        $text   =   $request->input("text");
                        if($text){
                            $value  =   LineMessageText::updateOrCreate(array(
                                "id"        =>  $id,
                            ),array(
                                "line_id"   =>  $line->id,
                                "name"      =>  $name,
                                "text"      =>  $text,
                            ));
                        }
                        break;
                }
                if($value){
                    $data["id"]         = $value->id            ?? null;
                    $data["status"]     = $value->status        ?? null;
                    $data["validate"]   = $value->validate      ?? null;
                    $data["html"]       = $value->get_html()    ?? null;
                }
                break;
        }
        return response()->json($data,200);
    }

    
    public function get_message_objects(Request $request, $line_name){
        $user   =   auth()->user();
        if(!$user){
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return response()->json(['error' => 'Line not found.'], 404);
        }
        $type       =   $request->input("message_object.type") ?? null;
        $status     =   $request->input("query_status", null);
        $objects    =   array();
        foreach($line->message_objects($type)->get() as $object){
            if($status && $status != $object->status){
                continue;
            }
            $objects[]  =   array(
                "id"        =>  $object->id,
                "name"      =>  $object->name,
                "status"    =>  $object->status,
                "validate"  =>  $object->validate,
                "html"      =>  $object->get_html(),
            );
        }
        $data   =   array(
            "message"   =>  "非同期成功",
            "type"      =>  $type,
            "objects"   =>  $objects,
        );
        return response()->json($data,200);
    }


}
