<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view("index");
    }
    public function redirect()
    {
        return view("redirect");
    }
    public function create()
    {
        return view("create");
    }
    public function store(Request $request)
    {
        return $request->all();
        return redirect("user_name");
    }
}
