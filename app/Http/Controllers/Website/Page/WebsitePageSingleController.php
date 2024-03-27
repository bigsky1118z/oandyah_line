<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageSingle;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageSingleController extends Controller
{
    public function index()
    {
        $data   =   array(
            "pages"   =>  WebsitePage::whereType("single")->get(),
        );
        return view("website.edit.page.single.index", $data);
    }

    public function create($page_id = null)
    {
        $data   =   array(
            "statuses"  =>  WebsitePage::$statuses,
        );
        $page   =   WebsitePage::whereId($page_id)->whereType("single")->first();
        if($page){
            WebsitePageSingle::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $data["page"] =   $page;
        }
        return view("website.edit.page.single.create", $data);
    }

    public function store(Request $request, $page_id = null)
    {
        $request->merge(array(
            'id'        =>  $page_id,
            'page_type' =>  "single",
        ));
        $page       =   WebsitePage::find($page_id);
        $page_path  =   $request->has("page_path")  ? $request->get("page_path")    : null;
        if($page && WebsitePage::check_path($page_path, $page->path)){
            $page->path  =  $page_path;
            $page->save();
        } elseif(!$page && WebsitePage::check_path($page_path)){
            $page   =   WebsitePage::Create(array(
                "type"  =>  "single",
                "path"  =>  $page_path,
                "name"  =>  $page_path,
            ));
        } else {
            return back()->withInput();
        }
        WebsitePage::updateOrCreate(array(
            "id"    =>  $page->id,
        ),array(
            "title"                 =>  $request->has("page_title")                 ? $request->get("page_title")               : $page->title,
            "image_thumbnail_url"   =>  $request->has("page_image_thumbnail_url")   ? $request->get("page_image_thumbnail_url") : $page->image_thumbnail_url,
            "image_header_url"      =>  $request->has("page_image_header_url")      ? $request->get("page_image_header_url")    : $page->image_header_url,
            "description"           =>  $request->has("page_description")           ? $request->get("page_description")         : $page->description,
            "status"                =>  $request->has("page_status")                ? $request->get("page_status")              : $page->status,
            "valid_at"              =>  $request->has("page_valid_at")              ? $request->get("page_valid_at")            : $page->valid_at,
            "expired_at"            =>  $request->has("page_expired_at")            ? $request->get("page_expired_at")          : $page->expired_at,
        ));
        
        $single =   $page->single;
        if($single){
            $single->body   =   $request->has("body") ? $request->get("body") : $single->body;
            $single->save();
        } else {
            $single =   WebsitePageSingle::Create(array(
                "website_page_id"   =>  $page->id,
                "body"              =>  $request->has("body") ? $request->get("body") : null,
            ));
        }
        return redirect("/edit/page/single");

    }


    // 公開

    public static function get($page)
    {
        $instance   =   new self();
        return $instance->single($page);
    }

    public function single($page)
    {
        if($page->single){
            $data   =   array(
                "page"      =>  $page,
            );
            return view("website.page.single", $data);
        }else{
            // 会員登録ページ
            return redirect("/");
        }

    }
}
