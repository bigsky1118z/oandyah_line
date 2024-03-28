<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Request $request,$user_name)
    {
        $data   =   array(
            "user"  =>  auth()->user(),
            "route" => $request->route("user_name"),
        );
        return view("app.index", $data);
    }
}
