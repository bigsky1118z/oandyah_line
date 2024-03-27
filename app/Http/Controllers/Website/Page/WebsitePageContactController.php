<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageContact;
use App\Models\Website\Page\WebsitePageContactForm;
use App\Models\Website\Page\WebsitePageContactPost;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageContactController extends Controller
{

    public function index()
    {
        $data   =   array(
            "pages"   =>  WebsitePage::whereType("contact")->get(),
        );
        return view("website.edit.page.contact.index", $data);
    }

    public function create($page_id = null)
    {
        $data   =   array(
            "post_statuses" =>  WebsitePageContactPost::$statuses,
            "form_values"   =>  WebsitePageContactForm::$form_values,
        );
        $page   =   WebsitePage::whereId($page_id)->whereType("contact")->first();
        if($page){
            WebsitePageContact::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $data["page"] =   $page;
        }
        return view("website.edit.page.contact.create", $data);
    }


    public static function get($page)
    {
        $instance   =   new self();
        return $instance->contact($page);
    }

    public function contact($page)
    {
        if($page->contact && $page->contact->forms()->whereActive(true)->exists()){
            $data   =   array(
                "page"      =>  $page,
            );
            return view("website.page.contact", $data);
        }else{
            // 会員登録ページ
            return redirect("/");
        }

    }



    // public static function get($page, $action = null)
    // {
    //     $instance   =   new self();
    //     if(!$action){
    //         return $instance->form($page);
    //     }
    //     if($action){
    //         switch($action){
    //             case("index"):
    //                 return $instance->index($page);
    //                 break;
    //         }
    //     }
    //     return redirect("/");
    // }

    public static function post($request ,$page)
    {
        $instance   =   new self();
        return $instance->posted($request, $page);
    }

    public function posted($request, $page){
        $values =   $request->all();
        unset($values["_token"]);
        $page->contact->set_post($values);
        return redirect("/$page->path");
    }
}
