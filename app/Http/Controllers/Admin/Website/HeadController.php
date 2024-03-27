<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Head;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    public function edit()
    {
        if(!Head::where('tag',"!=",'customize')->exists()){
            foreach(Head::$heads as $item){
                $head   =   new Head();
                $head->tag  =   $item['tag'];
                $head->name =   $item['name'];
                $head->save();
            }
        }
        if(!Head::where('tag','customize')->exists()){
            $head =  new Head();
            $head->tag    =   "customize";
            $head->name   =   "customize";
            $head->save();
        }
        $data = array(
            'default_heads'     =>  Head::where('tag',"!=",'customize')->get(),
            'customize_head'    =>  Head::where('tag','customize')->where('name','customize')->first(),
            'heads'             =>  Head::$heads,
        );
        return view('admin.website.head.index', $data);
    }


    public function update(Request $request)
    {
        $form   =   $request->all();
        unset($form['_token']);
        foreach(array_keys($form) as $tag){
            foreach(array_keys($form[$tag]) as $name){
                $value  =   $form[$tag][$name];
                $head   =   Head::whereTag($tag)->whereName($name)->first();
                if(!$head) {
                    $head   =   new Head();
                    $head->tag  =   $tag;
                    $head->name =   $name;
                }
                $head->value    =   $value;
                $head->save();
            }
        }
        return redirect('/admin/website');
    }
}
