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
    public function show(Request $request,$user_name,$app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $user->apps($app_name),
        );
        return view("app.show", $data);
    }

    public function webhook(Request $request,$user_name,$app_name)
    {
        return response()->json([],200);
    }

}
