<?php

namespace App\Http\Controllers\Website\Page;

use App\Http\Controllers\Controller;
use App\Models\Website\Page\WebsitePageContact;
use App\Models\Website\Page\WebsitePageContactForm;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageContactFormController extends Controller
{
    public function create($page_id)
    {
        $page   =   WebsitePage::whereId($page_id)->whereType("contact")->first();
        if($page){
            $contact    =   WebsitePageContact::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $data   =   array(
                "page"          =>  $page,
                "forms"         =>  $contact->forms,
                "form_values"   =>  WebsitePageContactForm::$form_values,
            );
            return view("website.edit.page.contact.form", $data);
        } else {
            return back()->withInput();
        }
    }

    public function store(Request $request, $page_id)
    {
        $page   =   WebsitePage::whereType("contact")->whereId($page_id)->first();
        if($page){
            $request->merge(array(
                'page_id'       =>  $page->id,
                'page_path'     =>  $page->path,
            ));
            $contact   =   WebsitePageContact::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $forms          =   $request->get("form");
            $form_values    =   WebsitePageContactForm::$form_values;
            foreach($forms as $name => $form){
                if(isset($form["active"])){
                    WebsitePageContactForm::updateOrCreate(array(
                        "website_page_contact_id"   =>  $contact->id,
                        "name"                      =>  $name,
                    ),array(
                        "active"                    =>  true,
                        "title"                     =>  isset($form["title"])       ? $form["title"]                : null,
                        "type"                      =>  isset($form_values[$name])  ? $form_values[$name]["type"]   : null,
                        "required"                  =>  isset($form["required"])    ? true                          : false,
                        "description"               =>  isset($form["description"]) ? $form["description"]          : null,
                        "order"                     =>  isset($form["order"])       ? $form["order"]                : null,
                    ));
                } else {
                    WebsitePageContactForm::updateOrCreate(array(
                        "website_page_contact_id"   =>  $contact->id,
                        "name"                      =>  $name,
                    ),array(
                        "active"                    =>  false,
                    ));
                }
            }
            WebsitePageContactForm::whereNotIn("name", array_keys($form_values))->delete();
            return redirect("/edit/page/contact/$page_id/edit");
        } else {
            return redirect("/redirect");
        }
    }
}
