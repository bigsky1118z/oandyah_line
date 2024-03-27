<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Menu;
use App\Models\Website\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'menus'     =>  Page::whereParent("menus")->get(),
        );
        return view("admin.website.menu.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            'resource'  =>  'create',
            'page_parents'  =>  Page::$page_parents,
        );
        return view("admin.website.menu.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, Menu::$rules);
        $form   =   $request->all();
        // 新規Page[parent=>menus]を作成する
        $page   =   new Page();
        $page->parent   =   "menus";
        $page->name     =   $form["menu_name"];
        $page->title    =   $form["menu_title"];
        $page->save();

        // 新規Menu[menu_id=>new Page->id]を作成する
        foreach($form['menus'] as $index => $menus){
            // Pageから連携してリンクを引用する
            if(isset($menus['name'])){
                $item   =   Page::whereParent($menus['parent'])
                                ->whereName($menus['name'])
                                ->first();
                if($item){
                    $menu           =   new Menu();
                    $menu->menu_id  =   $page->id;
                    $menu->page_id  =   $item->id;
                    $menu->title    =   $menus['title'];
                    $menu->index    =   $index;
                    $menu->save();
                }
            }
            // Pageに連携せずリンクとタイトルを直接作成する
            elseif(isset($menus['href'])) {
                $menu           =   new Menu();
                $menu->menu_id  =   $page->id;
                $menu->href     =   $menus['href'];
                $menu->title    =   $menus['title'];
                $menu->index    =   $index;
                $menu->save();
            }
        }
        return redirect('/admin/website/menu');
    }

    /**
     * Display the specified resource.
     */
    public function show($menu)
    {
        $data = array(
            'menus'     =>  Menu::whereMenuId($menu)->whereNotNull('index')->orderBy('index')->get(),
        );
        return view("admin.website.menu.show", $data);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($menu)
    {
        $page = Page::find($menu);
        $data = array(
            'resource'      =>  'edit',
            'id'            =>  $menu,
            'menu_name'     =>  $page->name,
            'menu_title'    =>  $page->title,
            'menus'         =>  Menu::whereMenuId($menu)->whereNotNull('index')->orderBy('index')->get(),
            'page_parents'  =>  Page::$page_parents,
        );
        return view("admin.website.menu.create", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request['id']  =   $id;
        $this->validate($request, Menu::$rules);
        $form   =   $request->all();
        $page   =   Page::find($id);
        $page->name     =   $form["menu_name"];
        $page->title    =   $form["menu_title"];
        $page->save();
        foreach(Menu::whereMenuId($id)->get() as $menu){
            $menu->index    =   null;
            $menu->save();
        };
        foreach($form['menus'] as $index => $menus){
            if(isset($menus['name'])){
                $item   =   Page::whereParent($menus['parent'])
                                ->whereName($menus['name'])
                                ->first();
                if($item){
                    $menu   =   Menu::whereMenuId($id)->wherePageId($item->id)->first();
                    if(!$menu){
                        $menu           =   new Menu();
                        $menu->menu_id  =   $id;
                        $menu->page_id  =   $item->id;
                    }
                    $menu->title    =   $menus['title'];
                    $menu->index    =   $index;
                    $menu->save();
            }
            } elseif(isset($menus['href'])) {
                $menu = Menu::whereHref($menus['href'])->first();
                if(!$menu) {
                    $menu   =   new Menu();
                    $menu->menu_id  =   $id;
                    $menu->href     =   $menus['href'];
                }
                $menu->title    =   $menus['title'];
                $menu->index    =   $index;
                $menu->save();
            }
        }
        return redirect('/admin/website/menu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        foreach(Menu::whereMenuId($id)->get() as $menu){
            $menu->delete();
        }
        foreach(Menu::wherePageId($id)->get() as $menu){
            $menu->delete();
        }
        Page::find($id)->delete();
        return redirect('/admin/website/menu');
    }

}
