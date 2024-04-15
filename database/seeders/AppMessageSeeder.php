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
            "status"    =>  "draft",
            "messages"  =>  array(
                array(
                    "type"  =>  "text",
                    "text"  =>  "新澤菜央様",
                ),
                array(
                    "type"  =>  "text",
                    "text"  =>  "天性のアイドルです。",
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
            ),
        ));

    }
}
