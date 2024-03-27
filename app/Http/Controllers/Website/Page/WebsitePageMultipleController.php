<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageMultiple;
use App\Models\Website\Page\WebsitePageMultipleArticle;
use App\Models\Website\WebsiteMembership;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageMultipleController extends Controller
{
    public function index()
    {
        $data   =   array(
            "pages"   =>  WebsitePage::whereType("multiple")->get(),
        );
        return view("website.edit.page.multiple.index", $data);
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
        $page   =   WebsitePage::whereId($page_id)->whereType("multiple")->first();
        if($page){
            WebsitePageMultiple::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $data["page"]   =   $page;
        }
        return view("website.edit.page.multiple.create", $data);
    }

    public function store(Request $request, $page_id = null)
    {
        $request->merge(array(
            'id'        =>  $page_id,
            'page_type' =>  "multiple",
        ));
        $page       =   WebsitePage::find($page_id);
        $page_path  =   $request->has("page_path") ? $request->get("page_path") : null;
        if($page && WebsitePage::check_path($page_path, $page->path)){
            $page->path  =  $page_path;
            $page->save();
        } elseif(!$page && WebsitePage::check_path($page_path)){
            $page   =   WebsitePage::Create(array(
                "type"  =>  "multiple",
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
        return redirect("/edit/page/multiple");
    }


    public function delete($page_id, $multiple_id)
    {
        $multiple   =   WebsitePageMultiple::whereWebsitePageId($page_id)->whereId($multiple_id)->first();
        if($multiple){
            $multiple->delete();
        }
        return redirect("/edit/multiple/$page_id");
    }


    // 公開

    public static function get($page, $article_path = null, $action = null)
    {
        $instance   =   new self();
        if(!$article_path && !$action){
            return $instance->multiple($page);
        }
        if($article_path && !$action){
            return $instance->article($page, $article_path);
        }
        if($article_path && $action){
            return $action;
        }
        return redirect("redirect");
    }

    public function multiple($page)
    {
        $data   =   array(
            "page"      =>  $page,
        );
        return view("website.page.multiple", $data);
    }

    public function article($page, $article_path)
    {
        $multiple   =   $page->multiple;
        $article    =   WebsitePageMultipleArticle::whereWebsitePageMultipleId($multiple->id)->wherePath($article_path)->first();
        if($article){
            $data   =   array(
                "page"      =>  $page,
                "article"   =>  $article,
            );
            return view("website.page.multiple_article", $data);
        } else {
            return redirect("/redirect");
        }
    }
}
