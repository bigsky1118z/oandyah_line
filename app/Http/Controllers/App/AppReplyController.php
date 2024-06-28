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
        $app        =   $user->app($client_id)->app ?? new App();
        $types      =   AppReply::$types;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
            "types" =>  $types,
        );
        return view("app.reply.index", $data);
    }
    public function create(Request $request, $user_name, $client_id, $app_reply_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app ?? new App();
        $reply  =   $app->reply($app_reply_id) ?? new AppReply();
        $data   =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "reply"     =>  $reply,
            "modes"     =>  AppReply::$modes,
            "matches"   =>  AppReply::$matches,
            "statuses"  =>  AppReply::$statuses,
        );
        return view("app.reply.create", $data);
    }
    public function store(Request $request, $user_name, $client_id, $app_reply_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app ?? new App();
        if($app->id){
            $reply  =   AppReply::updateOrCreate(array(
                "id"        =>  $app_reply_id,
            ),array(
                "type"      =>  $request->input("type")     ?? null,
                "name"      =>  $request->input("name")     ?? null,
                "mode"      =>  $request->input("mode")     ?? null,
                "match"     =>  $request->input("match")    ?? null,
                "keyword"   =>  array_filter(($request->input("keyword")  ?? array()), fn($keyword)=> $keyword),
            ));
            return redirect(asset("$user_name/app/$client_id/reply/$reply->id'"));
        } else {
            return back();
        }
    }

}
