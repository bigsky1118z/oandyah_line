<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $data   =   array(
            "users"  =>  User::all(),
        );
        return view("admin.user.index", $data);
    }

    public function show($user_id)
    {
        return User::find($user_id);
    }
}
