<?php

namespace Database\Seeders;

use App\Models\Website\WebsitePage;
use App\Models\Website\Page\WebsitePageMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $website_page_menu_header_id    =   WebsitePage::whereCategory("menu")->whereName("menu-header")->first()->id;
        WebsitePageMenu::Create(array(
            "website_page_id"           =>  $website_page_menu_header_id,
            "order"                     =>  (WebsitePageMenu::whereWebsitePageId($website_page_menu_header_id)->count()+1)+10,
            "type"                      =>  "relation",
            "pickup_website_page_id"    =>  WebsitePage::whereCategory("contact")->whereName("contact")->first()->id,
            "path"                      =>  null,
            "title"                     =>  null,
            "image_url"                 =>  null,
        ));

        WebsitePageMenu::Create(array(
            "website_page_id"           =>  $website_page_menu_header_id,
            "order"                     =>  (WebsitePageMenu::whereWebsitePageId($website_page_menu_header_id)->count()+1)+10,
            "type"                      =>  "relation",
            "pickup_website_page_id"    =>  WebsitePage::whereCategory("single")->whereName("concept")->first()->id,
            "path"                      =>  null,
            "title"                     =>  "あなたに伝えたいこと",
            "image_url"                 =>  null,
        ));

        WebsitePageMenu::Create(array(
            "website_page_id"           =>  $website_page_menu_header_id,
            "order"                     =>  (WebsitePageMenu::whereWebsitePageId($website_page_menu_header_id)->count()+1)+10,
            "type"                      =>  "direct",
            "pickup_website_page_id"    =>  null,
            "path"                      =>  "#",
            "title"                     =>  "隠しページに行くよ",
            "image_url"                 =>  null,
        ));

        $website_page_function_menu_footer_id = WebsitePage::whereCategory("menu")->whereName("menu-footer")->first()->id;
        WebsitePageMenu::Create(array(
            "website_page_id"           =>  $website_page_function_menu_footer_id,
            "order"                     =>  (WebsitePageMenu::whereWebsitePageId($website_page_function_menu_footer_id)->count()+1)+10,
            "type"                      =>  "direct",
            "pickup_website_page_id"    =>  null,
            "path"                      =>  "#",
            "title"                     =>  "トップへ戻る",
            "image_url"                 =>  null,
        ));
    }
}
