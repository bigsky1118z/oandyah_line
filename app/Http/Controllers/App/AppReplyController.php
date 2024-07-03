<?php

namespace App\Http\Controllers\App;

use App\Models\App;
use App\Models\App\AppReply;
use App\Models\User;
use Illuminate\Http\Request;

class AppReplyController extends Controller
{
    public function index(Request $request, $user_name, $client_id)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app ??  new App();
        $types      =   
        $categories =   
        $data   =   array(
            "user"          =>  $user,
            "app"           =>  $app,
            "types"         =>  AppReply::$types        ??  array(),
            "categories"    =>  AppReply::$categories   ??  array(),
        );
        return view("app.reply.index", $data);
    }
    public function create(Request $request, $user_name, $client_id, $app_reply_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app ?? new App();
        $reply  =   $app->reply($app_reply_id)  ?? new AppReply();
        $data   =   array(
            "user"          =>  $user,
            "app"           =>  $app,
            "reply"         =>  $reply,
            "types"         =>  AppReply::$types        ??  array(),
            "categories"    =>  AppReply::$categories   ??  array(),
            "modes"         =>  AppReply::$modes        ??  array(),
            "matches"       =>  AppReply::$matches      ??  array(),
            "statuses"      =>  AppReply::$statuses     ??  array(),
        );
        return view("app.reply.create", $data);
    }
    public function store(Request $request, $user_name, $client_id, $app_reply_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app ?? new App();
        if($app->id){
            $query  =   $request->input("query") ?? array();
            $query  =   AppReply::convert_query($query);
            $reply  =   AppReply::updateOrCreate(array(
                "id"        =>  $app_reply_id,
            ),array(
                "app_id"    =>  $app->id,
                "type"      =>  $request->input("type")     ?? null,
                "name"      =>  $request->input("name")     ?? null,
                "mode"      =>  $request->input("mode")     ?? null,
                "query"     =>  $query,
                "status"    =>  $request->input("status")   ?? null,
            ));
            return redirect(asset("$user_name/app/$client_id/reply/$reply->id'"));
        } else {
            return back();
        }
    }

}
