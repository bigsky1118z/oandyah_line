<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request)
    {
        return view("index");
    }
    public function redirect(Request $request)
    {
        return view("redirect");
    }
    public function create(Request $request)
    {
        return view("create");
    }
    public function store(Request $request)
    {
        return $request->all();
        return redirect("user_name");
    }
    public function show(Request $request,$user_name)
    {
        $data   =   array(
            "user"  =>  auth()->user(),
        );
        return view("show", $data);
    }

}
