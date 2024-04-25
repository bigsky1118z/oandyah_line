<?php

namespace App\Http\Controllers\App;

use App\Models\App\AppReply;
use App\Models\App\AppReplyCondition;
use App\Models\User;
use Illuminate\Http\Request;

class AppReplyController extends Controller
{
    public function index(Request $request, $user_name, $app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.reply.index", $data);
    }

    public function show(Request $request, $user_name, $app_name, $id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        return AppReply::whereAppId($app->id)->whereId($id)->first();
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
