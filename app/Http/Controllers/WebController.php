<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request)
    {
        return view("index");
    }
    public function create(Request $request)
    {
        return view("create");
    }
    public function show(Request $request, $user_name)
    {
        $user   =   User::find(auth()->user()->id);
        $data   =   array(
            "user"  =>  $user,
        );
        return view("show", $data);
    }
    public function redirect(Request $request)
    {
        return view("redirect");
    }
}
