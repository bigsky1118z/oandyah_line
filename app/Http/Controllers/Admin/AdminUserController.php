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

    public function create($user_id = null)
    {
        $data   =   array(
            "user"  =>  User::find($user_id) ?? new User(),
        );
        return view("admin.user.create", $data);
        
    }
}
