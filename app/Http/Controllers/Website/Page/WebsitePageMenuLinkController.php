<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageMenu;
use App\Models\Website\Page\WebsitePageMenuLink;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageMenuLinkController extends Controller
{
    public function create($page_id)
    {
        $data   =   array();    
        $page   =   WebsitePage::whereId($page_id)->whereType("menu")->first();
        if($page){
            $menu   =   WebsitePageMenu::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $data   =   array(
                "page"  =>  $page,
                "links" =>  $menu->links,
            );
            return view("website.edit.page.menu.link", $data);
        } else {
            return back()->withInput();
        }
    }

    public function store(Request $request, $page_id)
    {
        $page   =   WebsitePage::whereType("menu")->whereId($page_id)->first();
        if($page){
            $request->merge(array(
                'page_id'       =>  $page->id,
                'page_path'     =>  $page->path,
            ));
            $menu   =   WebsitePageMenu::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $links  =   $request->get("link");
            $links  =   array_filter($links, fn($link)=> $link['order']);
            usort($links, fn($a, $b)=>  - $a['order'] + $b['order']);
            WebsitePageMenuLink::whereWebsitePageMenuId($menu->id)->update(array("order" => null));
            foreach($links as $link){
                if(isset($link["path"], $link["title"], $link["order"])){
                    WebsitePageMenuLink::updateOrCreate(array(
                        "website_page_menu_id"  =>  $menu->id,
                        "path"                  =>  $link["path"],
                        "title"                 =>  $link["title"],
                    ),array(
                        "image_thumbnail_url"   =>  isset($link["image_thumbnail_url"]) ? $link["image_thumbnail_url"] : null,
                        "description"           =>  isset($link["description"]) ? $link["description"] : null,
                        "order"                 =>  $link["order"],
                    ));
                }
            }
            return redirect("/edit/page/menu/$page_id/edit");
        } else {
            return redirect("/redirect");
        }
    }
}
