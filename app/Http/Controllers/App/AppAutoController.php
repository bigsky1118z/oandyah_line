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
        $autos      =   AppAuto::whereAppId($app->id)->whereType("follow")->get();
        return $autos;
        return view("app.auto.index", $data);
    }
}
