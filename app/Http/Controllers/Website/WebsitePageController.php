<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\WebsiteMembership;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageController extends Controller
{
    public function index()
    {
        $data   =   array(
            "types"     =>  WebsitePage::$types,
            "statuses"  =>  WebsitePage::$statuses,
            "pages"     =>  WebsitePage::whereNot("type", "regulated")->get()->groupBy("type"),
        );
        return view("website.edit.page.index", $data);
    }

    public function subdirectory()
    {
        $data   =   array(
            "subdirectories"    =>  WebsitePage::$subdirectories,
        );
        return view("website.edit.page.subdirectory.index", $data);
    }

    public function delete($page_id)
    {
        $validated_types    =   array("regulated", "subdirectory");
        $page               =   WebsitePage::find($page_id);
        $type               =   $page->type;
        if($page && !in_array($type, $validated_types)){
            $page->delete();
            return redirect("/edit/page/$type");
        } else {
            return back();
        }
    }
}
