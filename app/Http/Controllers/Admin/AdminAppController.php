<?php

namespace App\Http\Controllers\Admin;

use App\Models\App;
use Illuminate\Http\Request;

class AdminAppController extends Controller
{
    public function index()
    {
        $data   =   array(
            "apps"  =>  App::all(),
        );
        return view("admin.app.index", $data);
    }

    public function create($app_id = null)
    {
        $data   =   array(
            "app"  =>  App::find($app_id) ?? new App(),
        );
        return view("admin.app.create", $data);
    }

    public function store(Request $request, $app_id = null)
    {
        return $request->all();
    }
}
