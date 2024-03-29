<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data   =   array(
            "users"  =>  User::all(),
        );
        return view("admin.index", $data);
    }
    public function redirect()
    {
        return view("admin.redirect");
    }

}
