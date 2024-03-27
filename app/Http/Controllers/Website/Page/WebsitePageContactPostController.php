<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageContact;
use App\Models\Website\Page\WebsitePageContactPost;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageContactPostController extends Controller
{
    public function index($page_id)
    {
        $page   =   WebsitePage::whereId($page_id)->whereType("contact")->first();
        if($page){
            $contact    =   WebsitePageContact::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $data   =   array(
                "page"      =>  $page,
                "statuses"  =>  WebsitePageContactPost::$statuses,
                "posts"     =>  $contact->posts,
            );
            return view("website.edit.page.contact.post", $data);
        } else {
            return back()->withInput();
        }
    }
}
