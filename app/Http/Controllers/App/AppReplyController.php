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
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app ?? new App();
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.reply.index", $data);
    }
    public function create(Request $request, $user_name, $client_id, $app_reply_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app ?? new App();
        $reply  =   $app->reply($app_reply_id) ?? new AppReply();
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
            "reply" =>  $reply,
        );
        return view("app.reply.create", $data);
    }

}
