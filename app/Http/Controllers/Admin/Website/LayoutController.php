<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Layout;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function edit()
    {
        $data   =   array(
            "layout"    =>  Layout::latest()->first(),
        );
        return view('admin.website.layout.index', $data);
    }
    public function update(Request $request)
    {
        $form           =   $request->all();
        if(array_key_exists($form['select'], Layout::$layout_names)){
            $layout         =   new Layout();
            $layout->name   =   $form['select'];
            $layout->save();
        }
        return redirect('/admin/website');
    }
}
