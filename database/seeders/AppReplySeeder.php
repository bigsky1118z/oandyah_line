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
        $replies    =   array(
            array(
                "type"      =>  "follow",
                "name"      =>  "友達追加",
                "mode"      =>  "random",
                "match"     =>  "exact",
                "keyword"   =>  array(),
                "messages"  =>  array(
                    ["友達追加1","友達追加ありがとうございます！神宮寺大空です！何でも相談してください！"],
                    ["友達追加2","友達追加ありがとうございます！神宮寺大空です！おあいできてうれしいです！"],
                    ["友達追加3","友達追加ありがとうございます！神宮寺大空です！いつでも相談に乗りますよ！"],
                ),
            ),
            array(
                "type"      =>  "message",
                "name"      =>  "あいさつ",
                "mode"      =>  "random",
                "match"     =>  "exact",
                "keyword"   =>  array("こんにちは","おはよう","おはようございます","こんばんは"),
                "messages"  =>  array(
                    ["あいさつ1","今日も気分はいいですか？"],
                    ["あいさつ2","いつも連絡してくれてありがとうございます、嬉しい！"],
                    ["あいさつ3","何かご相談ですか？"],
                ),
            ),
            array(
                "type"      =>  "message",
                "name"      =>  "タロット占い",
                "mode"      =>  "random",
                "match"     =>  "partial",
                "keyword"   =>  array("タロット","占い","運勢"),
                "messages"  =>  array(
                    ["愚者","愚者のカードがでたあなたは新しい挑戦のときです。ずっとやってみたかったことにはなんですか"],
                    ["魔術師","魔術師のカードがでたあなたは実行に移すタイミングです。これまでの準備が実を結び始めます"],
                    ["女教皇","女教皇のカードがでたあなたは…"],
                ),
            ),
            array(
                "type"      =>  "message",
                "name"      =>  "自動返信",
                "mode"      =>  "random",
                "match"     =>  "partial",
                "keyword"   =>  array(""),
                "messages"  =>  array(
                    ["自動返信","[自動返信]お返事いたします。少々お待ちください。"],
                    ["自動返信","[自動返信]後ほどお返事いたします。ちょっとだけ待ってください！"],
                ),
            ),
        );
        foreach($replies as $reply){
            $app_reply  =   AppReply::Create(array(
                "app_id"    =>  $app->id,
                "type"      =>  $reply["type"] ?? null,
                "name"      =>  $reply["name"] ?? null,
                "mode"      =>  $reply["mode"] ?? null,
                "match"     =>  $reply["match"] ?? null,
                "keyword"   =>  $reply["keyword"] ?? array(),
                "status"    =>  "active",
            ));
            foreach($reply["messages"] as $message){
                $app_reply->create_simple_text_message(($message[0] ?? null),($message[1] ?? "失敗"));
            }
        }



        $app_reply      =   AppReply::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "type"      =>  "message",
            "match"     =>  "partial",
            "keyword"   =>  array(""),
            "status"    =>  "active",
            "mode"      =>  "random",
        ));
        $messages       =   array(
            ["最終","おいーっす！"],
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
