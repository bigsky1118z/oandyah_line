<?php

namespace App\Http\Controllers\App;

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
}
