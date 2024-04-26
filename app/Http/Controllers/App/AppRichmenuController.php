<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppRichmenu;
use App\Models\User;
use Illuminate\Http\Request;

class AppRichmenuController extends Controller
{
    public function index(Request $request, $user_name, $app_name)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($app_name)->app;
        $data   =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "richmenus" =>   AppRichmenu::get_richmenus($app->channel_access_token),
        );
        return $data["richmenus"];
        return view("app.richmenu.index", $data);
    }

    public function show(Request $request, $user_name, $app_name, $id)
    {
    }

    public function create(Request $request, $user_name, $app_name, $id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $data   =   array(
            "user"    =>  $user,
            "app"     =>  $app,
            "reply"   =>  $app->reply($id),
        );
        return view("app.reply.create", $data);
    }

    public function store(Request $request, $user_name, $app_name, $id = null)
    {
        return $request->all();
        return redirect("/$user_name/app/$app_name/reply");
    }
}
