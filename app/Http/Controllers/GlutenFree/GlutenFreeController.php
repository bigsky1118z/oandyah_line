<?php

namespace App\Http\Controllers\GlutenFree;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GlutenFreeController extends Controller
{
    public function index()
    {
        return view("gluten_free.index");
    }
    
}
