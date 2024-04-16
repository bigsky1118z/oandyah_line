<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppMessage;
use App\Models\User;
use Illuminate\Http\Request;

class AppMessageController extends Controller
{
    public function index(Request $request, $user_name, $app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.message.index", $data);
    }

    public function show(Request $request, $user_name, $app_name, $id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        return AppMessage::whereAppId($app->id)->whereId($id)->first();
    }

    public function create(Request $request, $user_name, $app_name, $id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $data   =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "message"   =>  $app->message($id),
        );
        return view("app.message.create", $data);

    }
}
