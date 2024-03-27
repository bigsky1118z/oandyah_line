<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;

use App\Models\Website\Content;
use App\Models\Website\Page;
use App\Rules\Hankaku;
use App\Services\RewriteService;
use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


use function PHPUnit\Framework\isEmpty;
use function Symfony\Component\String\b;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    protected $service;
    
     public function __construct(RewriteService $service)
     {
         $this->service = $service;
     }
 

    public function index()
    {
        $data = array(
            'resource'=> 'index',
            'contents' => Content::all(),
        );
        return view('admin.website.content.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            'resource'  =>  'create',
        );
        return view('admin.website.content.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules  = Content::$createRules;
        $this->validate($request, $rules);

        $page = new Page();
        $page->parent   = "contents";
        $page->name     = $request->page_name;
        $page->title    = $request->page_title;
        $page->save();
        
        $form   = $request->all();
        unset($form['_token']);
        unset($form['submit']);
        $form['page_id'] = $page->id;
        $form['body'] = $this->service->base64_to_file($form['body']);

        $content    =   new Content();
        $content->fill($form)->save();
        return redirect('/admin/website/content');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = array(
            'content'   =>  Content::find($id),
        );
        return view('admin.website.content.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $content    = Content::find($id);
        $data = array(
            'resource'  => 'edit',
            'content'   => $content,
        );
        $data['content']['page_name'] = Page::find($content->page_id)->name;
        return view('admin.website.content.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $request['id'] = $id;
        $rules  = Content::$editRules;
        $this->validate($request, $rules);

        
        $form   = $request->all();
        unset($form['_token']);
        unset($form['submit']);
        
        $page = Page::whereName($request->page_name)->first();
        $page_id = $page->id;
        $page['title'] = $request->page_title;
        $page->save();
        unset($form['page_title']);

        $form['body'] = $this->service->base64_to_file($form['body']);
        $form['page_id'] = $page_id;

        $content = Content::find($id);
        $content->fill($form)->save();

        return redirect('/admin/website/content');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Page::find(Content::find($id)->page_id)->delete();
        return redirect('/admin/website/content');
    }


}
