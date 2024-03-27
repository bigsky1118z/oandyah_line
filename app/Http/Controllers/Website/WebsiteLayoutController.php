<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\WebsiteLayout;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsiteLayoutController extends Controller
{
    public function index()
    {
        $data   =   array(
            "layouts"   =>  WebsiteLayout::whereNotNull("order")->get()->groupBy("type"),
            "types"     =>  array_merge(array("top" => "トップページ"), WebsitePage::$types),
        );
        return view("website.edit.layout.index",$data);
    }

    public function create($type)
    {
        $array  =   array_merge(array("top" => "トップページ"), WebsitePage::$types);
        $data   =   array(
            "layouts"   =>  WebsiteLayout::whereType($type)->whereNotNull("order")->get()->groupBy("target"),
            "type"      =>  $type,
            "title"     =>  isset($array[$type]) ? $array[$type] : null,
            "types"     =>  WebsitePage::$types,
            "pages"     =>  WebsitePage::whereNot("type", "regulated")->orderBy("type")->get(),
            "options"   =>  WebsiteLayout::$options,
        );
        return view("website.edit.layout.create",$data);
    }

    public function store(Request $request, $type)
    {
        if(isset(array_merge(array("top" => "トップページ") ,WebsitePage::$types)[$type])){
            foreach(array("header", "main", "footer") as $target){
                $layouts    =   $request->get($target);
                WebsiteLayout::whereType($type)->whereTarget($target)->update(array("order" => null));
                if($layouts){
                    $layouts    =   array_filter($layouts, fn($layout)=> $layout['order']);
                    usort($layouts, fn($a, $b)=> $a['order'] - $b['order']);
                    foreach($layouts as $layout){
                        if(isset($layout["page"], $layout["option"], $layout["order"])){
                            WebsiteLayout::updateOrCreate(array(
                                "type"              =>  $type,
                                "target"            =>  $target,
                                "website_page_id"   =>  $layout["page"],
                            ), array(
                                "option"            =>  $layout["option"],
                                "order"             =>  $layout["order"],
                            ));
                        }
                    }
                }
            }
            return redirect("/edit/layout");
        } else {
            return redirect("/redirect");
        }
        // $page   =   WebsitePage::whereType("menu")->whereId($page_id)->first();
        // if($page){
        //     $request->merge(array(
        //         'page_id'       =>  $page->id,
        //         'page_path'     =>  $page->path,
        //     ));
        //     $menu   =   WebsitePageMenu::updateOrCreate(array(
        //         "website_page_id"   =>  $page->id,
        //     ));
        //     $links  =   $request->get("link");
        //     $links  =   array_filter($links, fn($link)=> $link['order']);
        //     usort($links, fn($a, $b)=>  - $a['order'] + $b['order']);
        //     WebsitePageMenuLink::whereWebsitePageMenuId($menu->id)->update(array("order" => null));
        //     foreach($links as $link){
        //         if(isset($link["path"], $link["title"], $link["order"])){
        //             WebsitePageMenuLink::updateOrCreate(array(
        //                 "website_page_menu_id"  =>  $menu->id,
        //                 "path"                  =>  $link["path"],
        //                 "title"                 =>  $link["title"],
        //             ),array(
        //                 "order"                 =>  $link["order"],
        //             ));
        //         }
        //     }
        //     return redirect("/edit/page/menu/$page_id/edit");
        // } else {
        //     return redirect("/redirect");
        // }
    }


}
