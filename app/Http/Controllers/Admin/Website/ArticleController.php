<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Article;
use App\Models\Website\Page;
use App\Services\RewriteService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $service;
    
     public function __construct(RewriteService $service)
     {
         $this->service = $service;
     }
 

     public function index()
     {
        $data = array(
            'articles' => Page::whereParent("articles")->get(),
        );
        return view('admin.website.article.index', $data);
     }

     public function page($page_name)
     {
        $page = Page::whereName($page_name)->first();
        $data = array(
            'resource'  =>  'page_index',
            'articles'  =>  Article::wherePageId($page->id)->get(),
            "page_name" =>  $page_name,
        );
        return view('admin.website.article.page', $data);
     }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create($page_name)
    {
        $data = array(
            'resource'  =>  'create',
            'page_name' =>  $page_name,
        );
        return view('admin.website.article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($page_name, Request $request)
    {
        $rules  = Article::$createRules;
        $this->validate($request, $rules);

        $form   = $request->all();
        unset($form['_token']);
        unset($form['submit']);
        $form['page_id'] = Page::whereName($page_name)->first()->id;
        $form['body'] = $this->service->base64_to_file($form['body']);

        $article    =   new Article();
        $article->fill($form)->save();
        return redirect('/admin/website/article');
    }

    /**
     * Display the specified resource.
     */
    public function show($page_name, $path)
    {
        $page = Page::whereName($page_name)->first();
        $data = array(
            'resource'  =>  'show',
            'article'   =>  Article::wherePageId($page->id)
            ->wherePath($path)
            ->first(),
        );
        return view('admin.website.article.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($page_name)
    {
        $page       = Page::whereName($page_name)->first();
        $article    = Article::wherePageId($page->id)->first();
        $data       = array(
            'resource'  => 'edit',
            'article'   => $article,
            'page_name' => $page_name,
        );
        return view('admin.website.article.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($page_name, $path, Request $request)
    {   
        $rules  = Article::$createRules;
        $this->validate($request, $rules);

        $form   = $request->all();
        unset($form['_token']);
        unset($form['submit']);
        $page = Page::whereName($page_name)->first();
        $form['page_id'] = $page->id;
        $form['body'] = $this->service->base64_to_file($form['body']);

        $article = Article::wherePageId($page->id)->wherePath($path)->first();
        $article->fill($form)->save();
        return redirect('/admin/website/article');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($page_name, $path)
    {
        $page   = Page::whereName($page_name)->first();
        Article::wherePageId($page->id)->wherePath($path)->first()->delete();
        return redirect('/admin/website/article');
    }


}
