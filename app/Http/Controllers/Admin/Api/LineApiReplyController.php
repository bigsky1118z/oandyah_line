<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiMessage;
use App\Models\Api\LineApiReply;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class LineApiReplyController extends Controller
{
    /** /api/line/{$channel_name}/reply */
    public function index($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "replies"   =>  LineApiReply::whereChannelName($channel_name)->whereActive(true)->get()->groupBy("type"),
        );
        return view('admin.api.line.reply.index', $data);
    }

    public function store(Request $request, $channel_name, $type)
    {
        $line_api_reply =   new LineApiReply(array(
            "channel_name"          =>  $channel_name,
            "name"                  =>  $request->get("name"),
            "type"                  =>  $type,
            "active"                =>  false,
            "line_api_message_1_id" =>  isset($request->get("massages")[0]) ? $request->get("massages")[0] : null,
            "line_api_message_2_id" =>  isset($request->get("massages")[1]) ? $request->get("massages")[1] : null,
            "line_api_message_3_id" =>  isset($request->get("massages")[2]) ? $request->get("massages")[2] : null,
            "line_api_message_4_id" =>  isset($request->get("massages")[3]) ? $request->get("massages")[3] : null,
            "line_api_message_5_id" =>  isset($request->get("massages")[4]) ? $request->get("massages")[4] : null,
            "notification_disabled" =>  $request->get("notificationDisabled") ? true : false,
            "valid_at"              =>  $request->has("valid_at") ? $request->get("valid_at") : null,
            "expired_at"            =>  $request->has("expired_at") ? $request->get("expired_at") : null,
        ));
        switch($type){
            case("follow"):
                $line_api_reply["condition"]    =   $request->get("condition");
                break;
        }
        $line_api_reply->save();
        return redirect("/api/line/$channel_name/reply/$type");
    }

    public function update(Request $request, $channel_name, $type, $id)
    {
        $line_api_reply =   LineApiReply::whereChannelName($channel_name)->whereType($type)->whereId($id)->first();
        if($line_api_reply){
            $line_api_reply->name                   =   $request->get("name");
            $line_api_reply->line_api_message_1_id  =   isset($request->get("massages")[0]) ? $request->get("massages")[0] : null;
            $line_api_reply->line_api_message_2_id  =   isset($request->get("massages")[1]) ? $request->get("massages")[1] : null;
            $line_api_reply->line_api_message_3_id  =   isset($request->get("massages")[2]) ? $request->get("massages")[2] : null;
            $line_api_reply->line_api_message_4_id  =   isset($request->get("massages")[3]) ? $request->get("massages")[3] : null;
            $line_api_reply->line_api_message_5_id  =   isset($request->get("massages")[4]) ? $request->get("massages")[4] : null;
            $line_api_reply->notification_disabled  =   $request->get("notificationDisabled") ? true : false;
            $line_api_reply->valid_at               =   $request->has("valid_at") ? $request->get("valid_at") : null;
            $line_api_reply->expired_at             =   $request->has("expired_at") ? $request->get("expired_at") : null;

        }
        switch($type){
            case("follow"):
                $line_api_reply["condition"]    =   $request->get("condition");
                break;
        }
        $line_api_reply->save();
        return redirect("/api/line/$channel_name/reply/$type");
    }

    public function active ($channel_name, $type, $id)
    {
        $data   =   array();
        $line_api_reply =   LineApiReply::whereChannelName($channel_name)->whereType($type)->whereId($id)->first();
        if($line_api_reply){
            $line_api_reply->active =   true;
            $line_api_reply->save();
            $data["message"]        =   $line_api_reply->name . "を有効にしました。";
        }else{
            $data["message"]        =   "一致するデータが見つかりません。";
        }
        return response()->json($data,200);
    }

    public function inactive ($channel_name, $type, $id)
    {
        $data   =   array();
        $line_api_reply =   LineApiReply::whereChannelName($channel_name)->whereType($type)->whereId($id)->first();
        if($line_api_reply){
            $line_api_reply->active =   false;
            $line_api_reply->save();
            $data["message"]        =   $line_api_reply->name . "を無効にしました。";
        }else{
            $data["message"]        =   "一致するデータが見つかりません。";
        }
        return response()->json($data,200);
    }


    /** follow */
        public function follow($channel_name)
        {
            $data   =   array(
                "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "replies"   =>  LineApiReply::whereChannelName($channel_name)->whereType("follow")->get()->groupBy("condition"),
            );
            return view('admin.api.line.reply.follow.index', $data);
        }

        public function follow_create($channel_name)
        {
            $data   =   array(
                "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "line_api_messages" =>  LineApiMessage::whereChannelName($channel_name)->whereDisplay("表示")->orderBy("category")->get(),
            );
            return view('admin.api.line.reply.follow.create', $data);
        }

        public function follow_show($channel_name, $id)
        {
            $data   =   array(
                "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "reply"             =>  LineApiReply::whereChannelName($channel_name)->whereType("follow")->whereId($id)->first(),
            );
            return view('admin.api.line.reply.follow.show', $data);
        }

        public function follow_edit($channel_name, $id)
        {
            $data   =   array(
                "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "reply"             =>  LineApiReply::whereChannelName($channel_name)->whereType("follow")->whereId($id)->first(),
                "line_api_messages" =>  LineApiMessage::whereChannelName($channel_name)->whereDisplay("表示")->orderBy("category")->get(),
            );
            return view('admin.api.line.reply.follow.create', $data);
        }

        public function follow_delete($channel_name, $id)
        {
            $line_api_reply =   LineApiReply::whereChannelName($channel_name)->whereType("follow")->whereNot("condition","default")->whereId($id)->first();
            if($line_api_reply){
                $line_api_reply->delete();
                return redirect("/api/line/$channel_name/reply/follow");
            }else{
                return back();
            }
        }

        public function follow_active (Request $request, $channel_name)
        {
            $data   =   array(
                "messages"  =>  array(),
            );
            if($request->exists("inactive")){
                $inactive    =   LineApiReply::where("id",$request->get("inactive"))->whereChannelName($channel_name)->whereType("follow")->first();
                if($inactive){
                    $inactive->active   =   false;
                    $inactive->save();
                    $data["messages"][] =  $inactive->id . "を無効にしました。";
                }
            }
            if($request->exists("active")){
                $active    =   LineApiReply::where("id",$request->get("active"))->whereChannelName($channel_name)->whereType("follow")->first();
                if($active){
                    $active->active =   true;
                    $active->save();
                    $data["messages"][] =  $active->id . "を有効にしました。";
                }
            }
            return response()->json($data,200);
        }

    /** postback */
    public function postback($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "replies"   =>  LineApiReply::whereChannelName($channel_name)->whereType("postback")->get()->groupBy(function($reply){
                $result =   "others";
                foreach(array_keys(LineApiReply::$postback_action_names) as $key){
                    str_contains($reply->condition,"action=$key") ? $result = $key : null;
                }
                $reply->condition == "default" ? $result = "default" : null;
                return $result;
            }),
            "postback_action_names" =>  LineApiReply::$postback_action_names,
        );
        return view('admin.api.line.reply.postback.index', $data);
    }


    public function postback_action($channel_name, $action)
    {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "action_names"      =>  LineApiReply::$postback_action_names,
            "action"            =>  $action,
            "grouped_replies"   =>  LineApiReply::whereChannelName($channel_name)->whereType("postback")->where("condition","like","%action=$action%")->orderByDesc("updated_at")->get()->groupBy("name"),
        );
        return view("admin.api.line.reply.postback.$action.index", $data);
    }
    public function postback_action_create($channel_name, $action)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        
        return view("admin.api.line.reply.postback.$action", $data);
    }

    public function postback_action_store($channel_name, $action)
    {
        return redirect("/api/line/$channel_name/reply/postback/$action");
    }

    public function postback_action_edit($channel_name, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view('admin.api.line.reply.postback_create', $data);
    }


    public function type_default_active (Request $request, $channel_name, $type)
    {
        $data   =   array(
            "messages"  =>  array(),
        );
        if($request->exists("inactive")){
            $inactive    =   LineApiReply::where("id",$request->get("inactive"))->where("channel_name", $channel_name)->where("type", $type)->first();
            if($inactive){
                $inactive->active   =   false;
                $inactive->save();
                $data["messages"][] =  $inactive->id . "を無効にしました。";
            }
        }
        if($request->exists("active")){
            $active    =   LineApiReply::where("id",$request->get("active"))->where("channel_name", $channel_name)->where("type", $type)->first();
            if($active){
                $active->active =   true;
                $active->save();
                $data["messages"][] =  $active->id . "を有効にしました。";
            }
        }
        return response()->json($data,200);
    }

    public function type_action_delete($channel_name, $type, $action, $id)
    {
        $reply  =   LineApiReply::where("id", $id)
            ->where("channel_name", $channel_name)
            ->where("type", $type)
            ->where("action", $action)
            ->first();
        if($reply){
            $reply->delete();
        }
        return redirect("/api/line/$channel_name/reply/$type/$action");
    }

}
