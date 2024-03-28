<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index($user_name)
    {
        $user   =   auth()->user();
        if($user->user_name == $user_name){
            $data   =   array(
                "users"  =>  $user,
            );
            return view("app.index", $data);
        } else {
            return redirect("new");
        }
    }
}
