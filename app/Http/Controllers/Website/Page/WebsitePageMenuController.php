<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageMenu;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageMenuController extends Controller
{
    public function index()
    {
        $data   =   array(
            "pages"   =>  WebsitePage::whereType("menu")->get(),
        );
        return view("website.edit.page.menu.index", $data);
    }

    public function show($page_id)
    {
        return "preview";
    }


    public function create($page_id = null)
    {
        $data   =   array(
            "statuses"  =>  WebsitePage::$statuses,
        );
        $page   =   WebsitePage::whereId($page_id)->whereType("menu")->first();
        if($page){
            WebsitePageMenu::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $data["page"]   =   $page;
        }
        return view("website.edit.page.menu.create", $data);
    }

}
