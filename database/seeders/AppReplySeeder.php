<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppReply;
use App\Models\App\AppReplyMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app            =   App::where("client_id","1657423958")->first();
        $app_reply      =   AppReply::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "type"      =>  "follow",
            "match"     =>  null,
            "keyword"   =>  array(),
            "status"    =>  "active",
            "mode"      =>  "random",
        ));
        AppReplyMessage::Create(array(
            "app_reply_id"  =>  $app_reply->id,
            "name"          =>  "はじめまして",
            "messages"      =>  array(
                array(
                    "type"  =>  "text",
                    "text"  =>  "はじめまして{name}さん、私は神宮寺大空です。",
                ),
            ),
            "status"        =>  "active",
        ));
        $app_reply      =   AppReply::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "type"      =>  "message",
            "match"     =>  "partial",
            "keyword"   =>  array("はじめまして","こんにちは","さようなら"),
            "status"    =>  "active",
            "mode"      =>  "random",
        ));
        $messages       =   array(
            ["気分","あいさつありがとう、今日も気分はいいですか？"],
            ["いつも","いつも連絡してくれてありがとう。嬉しい。"],
            ["うかがい","何かご相談ですか？"]
        );
        foreach($messages as $message){
            AppReplyMessage::Create(array(
                "app_reply_id"  =>  $app_reply->id,
                "name"          =>  $message[0],
                "messages"      =>  array(
                    array(
                        "type"  =>  "text",
                        "text"  =>  $message[1],
                    ),
                ),
                "status"        =>  "active",
            ));
        }

    }
}
