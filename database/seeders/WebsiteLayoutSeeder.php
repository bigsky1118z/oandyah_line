<?php

namespace Database\Seeders;

use App\Models\Website\WebsitePage;
use App\Models\Website\WebsiteLayout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteLayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types      =   WebsitePage::$types;
        $targets    =   array(
            "header"    =>  array("menu_header"),
            "main"      =>  array("greeting", "concept", "news", "menu_links"),
            "footer"    =>  array("menu_footer"),
        );
        foreach($targets as $target => $paths){
            foreach($paths as $path){
                if(WebsitePage::wherePath($path)->exists()){
                    switch($target){
                        case "header":
                        case "footer":
                            foreach($types as $type => $title){
                                WebsiteLayout::Create(array(
                                    "website_page_id"   =>  WebsitePage::wherePath($path)->first()->id,
                                    "type"              =>  $type,
                                    "target"            =>  $target,
                                    "order"             =>  WebsiteLayout::whereType($type)->whereTarget($target)->count()+1,
                                    "option"            =>  "default",
                                ));
                            }
                        case "main":
                            WebsiteLayout::Create(array(
                                "website_page_id"   =>  WebsitePage::wherePath($path)->first()->id,
                                "type"              =>  "top",
                                "target"            =>  $target,
                                "order"             =>  WebsiteLayout::whereType("top")->whereTarget($target)->count()+1,
                                "option"            =>  "default",
                            ));
                            break;
                    }
                }
            }
        }
    }
}
