<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppReply;
use App\Models\App\AppMessageObject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $app    =   App::whereName("gluten_free")->first();
        $reply  =   AppReply::Create(array(
            "app_id"    =>  $app->id,
            "name"      =>  "友達追加",
            "status"    =>  "",
            "messages"  =>  [
                array(
                    "type"  =>  "text",
                    "text"  =>  "友達追加ありがとうございます！\nこれから役に立ついい情報を送りますね！",
                ),
            ],
        ));
        $condition  =   array();
        $reply->set_condition("follow", $condition, 1, true, true);

        $reply    =   AppReply::Create(array(
            "app_id"    =>  $app->id,
            "name"      =>  "新澤菜央様",
            "status"    =>  "",
            "messages"  =>  [
                array(
                    "type"  =>  "text",
                    "text"  =>  "新澤菜央様は天性のアイドルです。",
                ),
                array(
                    "type"      =>  "template",
                    "altText"   =>  "新澤菜央様は姫様です",
                    "template"  =>  array(
                        "type"      =>  "buttons",
                        "title"     =>  "新澤菜央",
                        "text"      =>  "しんしんに興味しんしん",
                        "actions"   =>  array(
                            array(
                                "type"  =>   "message",
                                "label" =>   "パンダといえば",
                                "text"  =>   "シャンシャン",
                            ),
                            array(
                                "type"  =>   "message",
                                "label" =>   "NMBといえば",
                                "text"  =>   "しんしん",
                            ),
                            array(
                                "type"  =>   "postback",
                                "label" =>   "どっちもみんな興味",
                                "data"  =>   "function=menu&menu=1",
                            ),
                            array(
                                "type"  =>   "postback",
                                "label" =>   "しんしん",
                                "data"  =>   "function=tarot&menu=1",
                            ),
                        ),
                    ),
                ),
            ],
        ));
        $condition  =   array();
        $reply->set_condition("message", $condition, 1, true, true);

        $reply    =   AppReply::Create(array(
            "app_id"    =>  $app->id,
            "name"      =>  "新澤菜央様",
            "status"    =>  "",
            "messages"  =>  [
                array(
                    "type"  =>  "text",
                    "text"  =>  "新澤菜央様がいれば世界が平和です。",
                ),
            ],
        ));
        $condition  =   array(
            "keyword"   =>  "しんしん",
            "match"     =>  "partial_match",
        );
        $reply->set_condition("message", $condition, 1, true, false);
        $condition  =   array(
            "keyword"   =>  "新澤",
            "match"     =>  "forward_match",
        );
        $reply->set_condition("message", $condition, 10, true, false);
        $condition  =   array(
            "keyword"   =>  "菜央",
            "match"     =>  "backward_match",
        );
        $reply->set_condition("message", $condition, 100, true, false);
        $condition  =   array(
            "keyword"   =>  "澤菜",
            "match"     =>  "partial_match",
        );
        $reply->set_condition("message", $condition, 1000, true, false);
        $condition  =   array(
            "keyword"   =>  "新澤菜央",
            "match"     =>  "exact_match",
        );
        $reply->set_condition("message", $condition, 1, true, false);


        $reply    =   AppReply::Create(array(
            "app_id"    =>  $app->id,
            "name"      =>  "応援",
            "status"    =>  "",
            "messages"  =>  [
                array(
                    "type"  =>  "text",
                    "text"  =>  "{name}、今日も一日頑張ろうね。",
                ),
            ],
        ));
        $condition  =   array(
            "function"  =>  "menu",
        );
        $reply->set_condition("postback", $condition, 1, true, false);

        $reply    =   AppReply::Create(array(
            "app_id"    =>  $app->id,
            "name"      =>  "褒め",
            "status"    =>  "",
            "messages"  =>  [
                array(
                    "type"  =>  "text",
                    "text"  =>  "{name}今日も一日頑張ったね。",
                ),
            ],
        ));
        $condition  =   array();
        $reply->set_condition("postback", $condition, 1, true, true);

    }
}
