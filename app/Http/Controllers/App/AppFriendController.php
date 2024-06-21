<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppFriend;
use App\Models\User;
use Illuminate\Http\Request;

class AppFriendController extends Controller
{
    public function index(Request $request, $user_name, $client_id)
    {
        return AppFriend::backup();
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.friend.index", $data);
    }

    public function show(Request $request,$user_name,$client_id, $friend_id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app;
        $friend =   $app->friend($friend_id);
        $data       =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "friend"    =>  $friend,
        );
        return view("app.friend.show", $data);
    }
}
