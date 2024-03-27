<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Top;
use App\Models\Website\Page;
use Faker\Core\Number;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function edit()
    {
        $data = array(
            'tops'  =>  Top::whereNotNull('index')->orderBy('index')->get(),
            'page_parents'  =>  Page::$page_parents,

            'pages' =>  Page::where('parent','!=', 'protected')->get()->groupBy('parent'),
        );
        return view('admin.website.top.index', $data);
    }


    public function update(Request $request)
    {
        foreach(Top::all() as $top){
            $top->delete();
        }
        foreach($request->get('tops') as $index => $top){
            if(isset($top['parent'])&& isset($top['name'])){
                $page   =   Page::whereParent($top['parent'])->whereName($top['name'])->first();
                if($page){
                    $new_top    =   new Top();
                    $new_top->index     =   $index;
                    $new_top->page_id   =   $page['id'];
                    if($top['parent']=="articles"){
                        $new_top->number    =   $top['number'];
                    }
                    if($top['option']){
                        $new_top->option    =   $top['option'];
                    }
                    $new_top->save();
                }
            }
        }
        return redirect('/admin/website');
    }
}
