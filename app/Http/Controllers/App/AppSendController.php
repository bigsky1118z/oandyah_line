<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppSend;
use App\Models\User;
use Illuminate\Http\Request;

class AppSendController extends Controller
{
    public function index(Request $request, $user_name, $app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.send.index", $data);
    }

    public function create(Request $request, $user_name, $client_id, $app_send_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app;
        // $send   =   $app->send($app_send_id) ?? new AppSend();
        $send   =   new AppSend();
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
            "send"  =>  $send,
        );
        return view("app.send.create", $data);
    }
    public function store(Request $request, $user_name, $client_id, $app_send_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app;
        return $request->all();

        // return view("app.send.create", $data);
    }

}
