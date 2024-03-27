<?php

namespace Database\Seeders;

use App\Models\Website\Page\WebsitePageMenuLink;
use App\Models\Website\WebsitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageMenuLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page   =   WebsitePage::whereType("menu")->wherePath("menu_header")->first();
        if($page){
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/",
                "title"                 =>  "home",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/concept",
                "title"                 =>  "理念",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/contact",
                "title"                 =>  "お問い合わせ",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/blog",
                "title"                 =>  "ブログ",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/login",
                "title"                 =>  "会員ログイン",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
        }

        $page   =   WebsitePage::whereType("menu")->wherePath("menu_footer")->first();
        if($page){
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/",
                "title"                 =>  "top page",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/jinguji_ozora",
                "title"                 =>  "神宮寺大空公式サイト",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/greeting",
                "title"                 =>  "ご挨拶",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/blog",
                "title"                 =>  "ブログ",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
        }

        $page   =   WebsitePage::whereType("menu")->wherePath("menu_links")->first();
        if($page){
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "/",
                "title"                 =>  "O&Yah",
                "description"           =>  "このサイトはO&Yahの公式サイトです。",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "https://google.com",
                "title"                 =>  "google",
                "description"           =>  "このサイトはgoogleの公式サイトです。",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "https://yahoo.co.jp",
                "title"                 =>  "yahoo",
                "description"           =>  "このサイトはyahooの公式サイトです。",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));
            WebsitePageMenuLink::Create(array(
                "website_page_menu_id"  =>  $page->menu->id,
                "path"                  =>  "https://www.nmb48.com/",
                "title"                 =>  "NMB48",
                "description"           =>  "このサイトはNMB48の公式サイトです。",
                "order"                 =>  WebsitePageMenuLink::whereWebsitePageMenuId($page->menu->id)->count()+1,
            ));

        }


    }
}
