<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiReaction;
use App\Models\Api\LineApiReceive;
use App\Models\Api\LineApiReply;
use Illuminate\Http\Request;

class LineApiReceiveController extends Controller
{
    public function index($channel_name) {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "receives"  =>  LineApiReceive::whereChannelName($channel_name)->get(),
        );
        return view('admin.api.line.receive.index', $data);
    }

    /** GET /api/line/{$channel_name}/receive/event */
    public function event($channel_name) {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "data"      =>  LineApiReceive::whereChannelName($channel_name)->get("event"),
        );
        return view('admin.api.line.receive.event', $data);
    }

    /** GET /api/line/{$channel_name}/receive/message */
    public function message($channel_name) {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "messages"  =>  LineApiReceive::whereChannelName($channel_name)->whereType("message")->get(),
        );
        return view('admin.api.line.receive.message', $data);
    }

    /** GET /api/line/{$channel_name}/receive/postback */
    public function postback($channel_name) {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "postbacks"         =>  LineApiReceive::whereChannelName($channel_name)->whereType("postback")->get(),
            "postback_actions"  =>  LineApiReply::$postback_action_names,
        );
        return view('admin.api.line.receive.postback.index', $data);
    }

    public function postback_order($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "actions"   =>  LineApiReply::$postback_action_names,
            "postbacks" =>  LineApiReceive::whereChannelName($channel_name)->whereType("postback")->where("postback", "like", "%action=order%")->get(),
        );
        return view("admin.api.line.receive.postback.order", $data);
    }


    public function postback_action($channel_name, $action) {
        $postbacks  =   LineApiReceive::whereChannelName($channel_name)->whereType("postback")
            ->where("postback", "like", "%action=$action%")
            ->get();
        $postback_action_names  =   $postbacks->map(function($postback){
            parse_str($postback->postback, $data);
            return isset($data["name"]) ? $data["name"] : null;
        })->unique();
        
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "actions"   =>  LineApiReply::$postback_action_names,
            "action"    =>  $action,
            "postbacks" =>  $postbacks,
            "names"     =>  $postback_action_names,
        );
        return view('admin.api.line.receive.postback.action', $data);
    }

    public function postback_action_name($channel_name, $action, $name) {
        $postbacks  = LineApiReceive::whereChannelName($channel_name)->whereType("postback")
        ->where("postback", "like", "%action=$action%")
        ->where("postback", "like", "%name=$name%");
        switch($action){
            case("order"):
                $postbacks->where("postback", "like", "%value=order%");
                $postbacks->whereDoesntHave("reactions", function($query){
                    $query->where("reaction","cancel");
                });
                break;
        }
        $postbacks   =  $postbacks->get();
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "actions"   =>  LineApiReply::$postback_action_names,
            "action"    =>  $action,
            "name"      =>  $name,
            "postbacks" =>  $postbacks,
        );
        return view("admin.api.line.receive.postback.$action", $data);
    }

    public function postback_action_name_reaction(Request $request, $channel_name, $action, $name)
    {
        $id         =   $request->get("id");
        $data       =   array();
        $receive    =   LineApiReceive::find($id);
        if($receive){
            if($receive->channel_name == $channel_name && strpos($receive->postback,"action=$action") !== false && strpos($receive->postback,"name=$name") !== false){
                $data["set"]  =   $request->get("set");
                if($request->get("set") === "set"){
                    $reaction   =   new LineApiReaction(array(
                        "line_api_receive_id"   =>  $receive->id,
                        "channel_name"          =>  $channel_name,
                        "reaction"              =>  $request->get("reaction"),
                    ));
                    $reaction->save();
                    $data["message"]    =   "リアクションを登録しました。";
                    $data["reaction"]   =   $reaction;
                } else {
                    LineApiReaction::where("line_api_receive_id",$receive->id)->where("reaction",$request->get("reaction"))->delete();
                    $data["message"]    =   "リアクションを削除しました。";
                }
            } else {
                $data["message"]    =   "データが一致しませんでした";
            }
        }
        return response()->json($data,200);
    }



}
