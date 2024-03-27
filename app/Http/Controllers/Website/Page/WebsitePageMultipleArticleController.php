<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageMultiple;
use App\Models\Website\Page\WebsitePageMultipleArticle;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageMultipleArticleController extends Controller
{
    public function show($page_id, $article_id)
    {
        return "preview";
    }
    
    public function create($page_id, $article_id = null)
    {
        $page   =   WebsitePage::whereType("multiple")->whereId($page_id)->first();
        if($page){
            $data   =   array(
                "page"      =>  $page,
                "statuses"  =>  WebsitePage::$statuses,
            );
            $multiple   =   $page->multiple;
            if($article_id && $multiple->articles($article_id)){
                $data["article"]    =   $multiple->articles($article_id);
            }
            return view("website.edit.page.multiple.article", $data);
        } else {
            return back()->withInput();
        }
    }

    public function store(Request $request, $page_id, $article_id = null)
    {
        $page       =   WebsitePage::whereType("multiple")->whereId($page_id)->first();
        if($page){
            $request->merge(array(
                'page_id'       =>  $page->id,
                'page_type'     =>  $page->type,
                'page_path'     =>  $page->path,
                'article_id'    =>  $article_id,
            ));
            $multiple   =   WebsitePageMultiple::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $article        =   WebsitePageMultipleArticle::whereWebsitePageMultipleId($multiple->id)->whereId($article_id)->first();
            $article_path   =   $request->has("article_path")  ? $request->get("article_path")    : null;
            if($article && WebsitePageMultipleArticle::check_path($article_path, $article->path)){
                $article->path  =  $article_path;
                $article->save();
            } elseif(!$article && WebsitePageMultipleArticle::check_path($article_path)){
                $article   =   WebsitePageMultipleArticle::Create(array(
                    "website_page_multiple_id"  =>  $multiple->id,
                    "path"                      =>  $article_path,
                ));
            } else {
                return back()->withInput();
            }
            WebsitePageMultipleArticle::updateOrCreate(array(
                "id"    =>  $article->id,
            ),array(
                "title"                 =>  $request->has("article_title")                  ? $request->get("article_title")                : $article->title,
                "image_thumbnail_url"   =>  $request->has("article_image_thumbnail_url")    ? $request->get("article_image_thumbnail_url")  : $article->image_thumbnail_url,
                "image_header_url"      =>  $request->has("article_image_header_url")       ? $request->get("article_image_header_url")     : $article->image_header_url,
                "status"                =>  $request->has("article_status")                 ? $request->get("article_status")               : $article->status,
                "valid_at"              =>  $request->has("article_valid_at")               ? $request->get("article_valid_at")             : $article->valid_at,
                "expired_at"            =>  $request->has("article_expired_at")             ? $request->get("article_expired_at")           : $article->expired_at,
                "body"                  =>  $request->has("article_body")                   ? $request->get("article_body")                 : $article->body,
            ));
            return redirect("/edit/page/multiple/$page->id/edit");
        } else {
            return redirect("/redirect");
        }
    }

    public function delete($page_id, $article_id)
    {
        $page   =   WebsitePage::whereType("multiple")->whereId($page_id)->first();
        if($page){
            $multiple   =   WebsitePageMultiple::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            WebsitePageMultipleArticle::whereWebsitePageMultipleId($multiple->id)->whereId($article_id)->delete();
            return redirect("/edit/page/multiple/$page_id/edit");
        } else {
            return back();
        }
    }

}
