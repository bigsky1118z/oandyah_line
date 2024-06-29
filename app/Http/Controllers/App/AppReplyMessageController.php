<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppReply;
use App\Models\App\AppReplyMessage;
use App\Models\User;
use Illuminate\Http\Request;

class AppReplyMessageController extends Controller
{
    public function create(Request $request, $user_name, $client_id, $app_reply_id, $app_reply_message_id = null)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $reply      =   $app->reply($app_reply_id)              ?? new AppReply();
        $message    =   $reply->message($app_reply_message_id)  ?? new AppReplyMessage();
        $data       =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "reply"     =>  $reply,
            "message"   =>  $message,
        );
        return view("app.reply.message.create", $data);
    }
    public function store(Request $request, $user_name, $client_id, $app_reply_id, $app_reply_message_id = null)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        // $message    =   AppMessage::updateOrCreate(array(
        //     "id"        =>  $app_reply_id,
        //     "app_id"    =>  $app->id,
        // ),array(
        //     "name"      =>  $request->input("name")         ?? now()->format("YmdHi"),
        //     "type"      =>  $request->input("type")         ?? null,
        //     "datetime"  =>  $request->input("datetime")     ?? null,
        //     "push"      =>  $request->input("push")         ?? null,
        //     "messages"  =>  AppMessage::convert_message_objects($request->input("messages")),
        // ));
        // $message    =   $message->latest();
        return redirect(asset("$user_name/app/$client_id/reply/"));
    }
}
