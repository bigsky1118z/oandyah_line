<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppMessage;
use App\Models\App\AppMessageObject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app        =   App::whereName("gluten_free")->first();
        $message    =   AppMessage::Create(array(
            "app_id"    =>  $app->id,
            "name"      =>  "友達追加",
            "status"    =>  "draft",
            "messages"  =>  [
                array(
                    "type"  =>  "text",
                    "text"  =>  "友達追加ありがとうございます！\nこれから役に立ついい情報を送りますね！",
                ),
            ],
        ));

        $message    =   AppMessage::Create(array(
            "app_id"    =>  $app->id,
            "name"      =>  "新澤菜央様",
            "status"    =>  "draft",
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
                                "data"  =>   "function=menu",
                            ),
                        ),
                    ),
                ),
            ],
        ));

    }
}
