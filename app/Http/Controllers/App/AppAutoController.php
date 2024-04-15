<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppAuto;
use App\Models\User;
use Illuminate\Http\Request;

class AppAutoController extends Controller
{
    public function index(Request $request, $user_name, $app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.auto.index", $data);
    }

    public function enable(Request $request, $user_name, $app_name)
    {
        $user   =   User::whereUserName($user_name)->first();
        $app    =   $user->app($app_name)->app;
        $id     =   $request->get("id");
        $enable =   $request->get("eneable");
        // $app->auto($id)->set_enable($enable);
        return response();
    }
}
