<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Content;
use App\Models\User;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }

    public function website()
    {
        return view('admin.website.index');
    }
    
    public function webapp()
    {
        return view('admin.webapp.index');
    }

}
