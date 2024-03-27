<?php

namespace Database\Seeders;

use App\Models\Website\Page\WebsitePageContactForm;
use App\Models\Website\WebsitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page   =   WebsitePage::whereType("contact")->wherePath("contact")->first();
        if($page){
            WebsitePageContactForm::Create(array(
                "website_page_contact_id"   =>  $page->contact->id,
                "active"                    =>  true,
                "name"                      =>  "email",
                "title"                     =>  "メールアドレス",
                "type"                      =>  "email",
                "required"                  =>  true,
                "description"               =>  "メールアドレスを入力してください",
                "order"                     =>  WebsitePageContactForm::whereWebsitePageContactId($page->contact->id)->count()+1,
            ));
            WebsitePageContactForm::Create(array(
                "website_page_contact_id"   =>  $page->contact->id,
                "active"                    =>  true,
                "name"                      =>  "name",
                "title"                     =>  "氏名",
                "type"                      =>  "text",
                "required"                  =>  true,
                "description"               =>  "氏名を入力してください",
                "order"                     =>  WebsitePageContactForm::whereWebsitePageContactId($page->contact->id)->count()+1,
            ));
            WebsitePageContactForm::Create(array(
                "website_page_contact_id"   =>  $page->contact->id,
                "active"                    =>  true,
                "name"                      =>  "nickname",
                "title"                     =>  "ニックネーム",
                "type"                      =>  "text",
                "required"                  =>  false,
                "description"               =>  "ニックネームを入力してください（任意）",
                "order"                     =>  WebsitePageContactForm::whereWebsitePageContactId($page->contact->id)->count()+1,
            ));

        }
    }
}
