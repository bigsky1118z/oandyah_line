<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index($user_name)
    {
        $data   =   array(
            "user"  =>  auth()->user(),
        );
        return view("app.index", $data);
    }
}
