<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'pages' =>  Page::all()->groupBy('parent'),
        );
        return view('admin.website.page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = array(
            'resource'  => 'create',
        );
        return view('admin.website.page.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = Page::rules($request);
        $this->validate($request, $rules);
        $form = $request->all();
        unset($form['_token']);
        $page = new Page();
        $page->fill($form)->save();
        return redirect('/admin/website/page');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = array(
            'page'     => Page::find($id),
            'resource'  => 'edit',
        );
        return view('admin.website.page.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request['id']  = $id;
        $rules = Page::$rules;
        $page   = Page::find($id);
        if($page->name == $request->name){
            unset($rules['name']);
        }
        $this->validate($request, $rules);
        $form = $request->all();
        unset($form['_token']);
        $page->fill($form)->save();
        return redirect('/admin/website/page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Page::find($id)->delete();
        return redirect('/admin/website');
    }
}
