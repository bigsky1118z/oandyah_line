<?php

namespace App\Http\Controllers\App;

use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Request $request,$user_name)
    {
        $data   =   array(
            "user"  =>  auth()->user(),
        );
        return view("app.index", $data);
    }

    public function create(Request $request,$user_name, $app_name = null)
    {
        $data   =   array(
            "user"  =>  auth()->user(),
        );
        return view("app.create", $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "app_name"  => ["required","unique:apps,app_name","min:4","max:16"],
            // "channel_access_token"  => ["required","unique:apps,channel_access_token"],
        ]);
        return $validated;
    }


    public function show(Request $request,$user_name,$app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $user->apps($app_name),
        );
        return view("app.show", $data);
    }

}
