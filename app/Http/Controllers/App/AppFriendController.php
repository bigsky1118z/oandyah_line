<?php

namespace App\Http\Controllers\App;

use App\Models\User;
use Illuminate\Http\Request;

class AppFriendController extends Controller
{
    public function index(Request $request, $user_name, $app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.friend.index", $data);
    }

    public function show(Request $request,$user_name,$app_name, $friend_id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $friend =   $app->friend($friend_id);
        $data       =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.friend.show", $data);
    }
}
