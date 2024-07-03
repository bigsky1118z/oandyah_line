<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppMessage;
use App\Models\App\AppMessageSend;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppMessageController extends Controller
{
    public function index(Request $request, $user_name, $client_id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.message.index", $data);
    }

    public function create(Request $request, $user_name, $client_id, $app_message_id = null)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $message    =   $app->message($app_message_id) ?? new AppMessage();
        $data       =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "message"   =>  $message,
        );
        if($message->status == "sent"){
            return view("app.message.show", $data);
        }
        return view("app.message.create", $data);
    }
    public function store(Request $request, $user_name, $client_id, $app_message_id = null)
    {
        // return AppMessage::convert_message_objects($request->input("messages"));
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $message    =   AppMessage::updateOrCreate(array(
            "id"        =>  $app_message_id,
            "app_id"    =>  $app->id,
        ),array(
            "name"      =>  $request->input("name")         ?? now()->format("YmdHi"),
            "type"      =>  $request->input("type")         ?? null,
            "datetime"  =>  $request->input("datetime")     ?? null,
            "push"      =>  $request->input("push")         ?? null,
            "messages"  =>  AppMessage::convert_message_objects($request->input("messages")),
            "status"    =>  "standby",
        ));
        $message    =   $message->latest();
        if($request->input("submit") == "send"){
            $message->send_message();
        }
        return redirect(asset("$user_name/app/$client_id/message"));
    }
    public function send(Request $request, $user_name, $client_id, $app_message_id)
    {
        $user           =   User::find(auth()->user()->id);
        $app            =   $user->app($client_id)->app;
        $app_message    =   $app->message($app_message_id);
        $app_message    ?   $app_message->send_message()    :   null;
        return redirect(asset("$user_name/app/$client_id/message"));
    }

}
