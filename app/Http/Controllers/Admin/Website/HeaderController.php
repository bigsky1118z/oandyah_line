<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Header;
use App\Models\Website\Page;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function edit()
    {
        $data   =   array(
            'headers'       =>  Header::whereNotNull('index')->orderBy('index')->get(),
            'page_parents'  =>  Page::$page_parents,
        );
        return view('admin.website.header.index', $data);
    }

    public function update(Request $request)
    {
        foreach(Header::all() as $header){
            $header->delete();
        }
        foreach($request->get('headers') as $index => $header){
            if(isset($top['parent'])&& isset($top['name'])) {
                $page   =   Page::whereParent($header['parent'])->whereName($header['name'])->first();
                if($page){
                    $new_header =   new Header();
                    $new_header->index      =   $index;
                    $new_header->page_id    =   $page['id'];
                    if($header['option']){
                        $new_header->option     =   $header['option'];
                    }
                    $new_header->save();
                }
            }
        }
        return redirect('/admin/website');
    }
}
