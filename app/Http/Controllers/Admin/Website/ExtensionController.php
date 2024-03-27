<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;

use App\Models\Website\Extension;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    public function edit() {
        $data   =   array(
            'extension' => Extension::all()->groupBy('section'),
        );
        return view('admin.website.extension.index', $data);
    }

    public function update(Request $request) {
        $form   =   $request->all();
        unset($form['_token']);
        foreach($form as $section => $items){
            foreach($items as $name => $value){
                $extension  =   Extension::whereSection($section)->whereName($name)->first();
                if($extension){
                    $extension->value   =   $value;
                    $extension->save();
                }
            }
        }
        return redirect('/admin/website');
    }
}
