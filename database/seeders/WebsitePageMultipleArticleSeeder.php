<?php

namespace Database\Seeders;

use App\Models\Website\Page\WebsitePageMultipleArticle;
use App\Models\Website\WebsitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageMultipleArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page   =   WebsitePage::whereType("multiple")->wherePath("news")->first();
        if($page){
            for($i = 1; $i <= 15; $i++){
                WebsitePageMultipleArticle::Create(array(
                    "website_page_multiple_id"  =>  $page->multiple->id,
                    "path"                      =>  "news-" . $i,
                    "title"                     =>  "投稿" . $i,
                    "body"                      =>  "This is a sumple artilce. The article Number is " . $i,
                    "status"                    =>  "published",
                    "valid_at"                  =>  date("2023-01-" . $i . " 00:00:00"),
                ));
            }
        }
        
        $page   =   WebsitePage::whereType("multiple")->wherePath("blog")->first();
        if($page){
            WebsitePageMultipleArticle::Create(array(
                "website_page_multiple_id"  =>  $page->multiple->id,
                "path"                      =>  "my_name_is_1",
                "title"                     =>  "私は?",
                "body"                      =>  "my name is ?",
                "status"                    =>  "published",
                "valid_at"                  =>  date("Y-m-d 00:00:00"),
            ));
            WebsitePageMultipleArticle::Create(array(
                "website_page_multiple_id"  =>  $page->multiple->id,
                "path"                      =>  "my_name_is_2",
                "title"                     =>  "私は!",
                "body"                      =>  "my name is !",
                "status"                    =>  "published",
                "valid_at"                  =>  date("Y-m-d 00:00:00"),
            ));
            WebsitePageMultipleArticle::Create(array(
                "website_page_multiple_id"  =>  $page->multiple->id,
                "path"                      =>  "my_name_is_3",
                "title"                     =>  "私は!?",
                "body"                      =>  "my name is !?",
                "status"                    =>  "published",
                "valid_at"                  =>  date("Y-m-d 00:00:00"),
            ));

        }
    }
}
