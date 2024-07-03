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
        $app        =   App::where("client_id","1657423958")->first();
        $replies    =   array(
            "follow"    =>  array(
                array(
                    "name"      =>  "友だち追加",
                    "category"  =>  "default",
                    "mode"      =>  "random",
                    "query"     =>  array(),
                    "messages"  =>  array(
                        ["友達追加1","友達追加ありがとうございます！神宮寺大空です！何でも相談してください！"],
                        ["友達追加2","友達追加ありがとうございます！神宮寺大空です！おあいできてうれしいです！"],
                        ["友達追加3","友達追加ありがとうございます！神宮寺大空です！いつでも相談に乗りますよ！"],    
                    ),
                ),
            ),
            "message"   =>  array(
                array(
                    "name"      =>  "あいさつ",
                    "category"  =>  "default",
                    "mode"      =>  "random",
                    "query"     =>  array(
                        "match"     =>  "exact",
                        "keywords"  =>  ["こんにちは","おはよう","こんばんは"],
                    ),
                    "messages"  =>  array(
                        ["あいさつ1","今日も気分はいいですか？"],
                        ["あいさつ2","いつも連絡してくれてありがとうございます、嬉しい！"],
                        ["あいさつ3","何かご相談ですか？"],
                    ),
                ),
                array(
                    "name"      =>  "タロット占い",
                    "category"  =>  "default",
                    "mode"      =>  "random",
                    "query"     =>  array(
                        "match"     =>  "partial",
                        "keywords"  =>  ["タロット","占い","運勢"],
                    ),
                    "messages"  =>  array(
                        ["愚者",    "愚者のカードがでたあなたは新しい挑戦のときです。\nずっとやってみたかったことにはなんですか"],
                        ["魔術師",  "魔術師のカードがでたあなたは実行に移すタイミングです。\nこれまでの準備が実を結び始めます"],
                        ["女教皇",  "女教皇のカードがでたあなたは一度冷静になってみましょう。\n"],
                    ),
                ),
                array(
                    "name"      =>  "自動返信",
                    "category"  =>  "default",
                    "mode"      =>  "random",
                    "query"     =>  array(
                        "match"     =>  "none",
                    ),
                    "messages"  =>  array(
                        ["自動返信","[自動返信]\nお返事いたします。少々お待ちください。"],
                        ["自動返信","[自動返信]\n後ほどお返事いたします。ちょっとだけ待ってください！"],
                    ),
                ),
            ),
            "postback"  =>  array(
                "name"      =>  "カード選択",
                "category"  =>  "tarot",
                "mode"      =>  "random",
                "query"     =>  array(
                    "function"  =>  "tarot",
                    "mode"      =>  "select",
                    "theme"     =>  "love",
                    "limit"     =>  "day",
                    "day"       =>  1,
                ),
                "messages"  =>  array(
                    ["愚者","The Fool(愚者)"],
                    ["魔術師","The Magician(魔術師)"],
                    ["女教皇","The High Priestess(女教皇)"],
                    ["女帝","The Empress(女帝)"],
                    ["皇帝","The Emperor(皇帝)"],
                    ["教皇","The Hierophant(教皇)"],
                    ["恋人たち","The Lovers(恋人たち)"],
                    ["戦車","The Chariot(戦車)"],
                    ["力","Strength(力)"],
                    ["隠者","The Hermit(隠者)"],
                    ["運命の輪","Wheel Of Fortune(運命の輪)"],
                    ["正義","Justice(正義)"],
                    ["つるされた男","The Hanged Man(つるされた男)"],
                    ["死神","Death(死神)"],
                    ["節制","Temperance(節制)"],
                    ["悪魔","The Devil(悪魔)"],
                    ["塔","The Tower(塔)"],
                    ["星","The Star(星)"],
                    ["月","The Moon(月)"],
                    ["太陽","The Sun(太陽)"],
                    ["審判","Judgement(審判)"],
                    ["世界","The World(世界)"],
                    ["ワンドのエース","Ace Of Wands(ワンドのエース)"],
                    ["ワンドの2","Two Of Wands(ワンドの2)"],
                    ["ワンドの3","Three Of Wands(ワンドの3)"],
                    ["ワンドの4","Four Of Wands(ワンドの4)"],
                    ["ワンドの5","Five Of Wands(ワンドの5)"],
                    ["ワンドの6","Six Of Wands(ワンドの6)"],
                    ["ワンドの7","Seven Of Wands(ワンドの7)"],
                    ["ワンドの8","Eight Of Wands(ワンドの8)"],
                    ["ワンドの9","Nine Of Wands(ワンドの9)"],
                    ["ワンドの10","Ten Of Wands(ワンドの10)"],
                    ["ワンドのペイジ","Page Of Wands(ワンドのペイジ)"],
                    ["ワンドのナイト","Knight Of Wands(ワンドのナイト)"],
                    ["ワンドのクイーン","Queen Of Wands(ワンドのクイーン)"],
                    ["ワンドのキング","King Of Wands(ワンドのキング)"],
                    ["カップのエース","Ace Of Cups(カップのエース)"],
                    ["カップの2","Two Of Cups(カップの2)"],
                    ["カップの3","Three Of Cups(カップの3)"],
                    ["カップの4","Four Of Cups(カップの4)"],
                    ["カップの5","Five Of Cups(カップの5)"],
                    ["カップの6","Six Of Cups(カップの6)"],
                    ["カップの7","Seven Of Cups(カップの7)"],
                    ["カップの8","Eight Of Cups(カップの8)"],
                    ["カップの9","Nine Of Cups(カップの9)"],
                    ["カップの10","Ten Of Cups(カップの10)"],
                    ["カップのペイジ","Page Of Cups(カップのペイジ)"],
                    ["カップのナイト","Knight Of Cups(カップのナイト)"],
                    ["カップのクイーン","Queen Of Cups(カップのクイーン)"],
                    ["カップのキング","King Of Cups(カップのキング)"],
                    ["ソードのエース","Ace Of Swords(ソードのエース)"],
                    ["ソードの2","Two Of Swords(ソードの2)"],
                    ["ソードの3","Three Of Swords(ソードの3)"],
                    ["ソードの4","Four Of Swords(ソードの4)"],
                    ["ソードの5","Five Of Swords(ソードの5)"],
                    ["ソードの6","Six Of Swords(ソードの6)"],
                    ["ソードの7","Seven Of Swords(ソードの7)"],
                    ["ソードの8","Eight Of Swords(ソードの8)"],
                    ["ソードの9","Nine Of Swords(ソードの9)"],
                    ["ソードの10","Ten Of Swords(ソードの10)"],
                    ["ソードのペイジ","Page Of Swords(ソードのペイジ)"],
                    ["ソードのナイト","Knight Of Swords(ソードのナイト)"],
                    ["ソードのクイーン","Queen Of Swords(ソードのクイーン)"],
                    ["ソードのキング","King Of Swords(ソードのキング)"],
                    ["ペンタクルのエース","Ace Of Pentacles(ペンタクルのエース)"],
                    ["ペンタクルの2","Two Of Pentacles(ペンタクルの2)"],
                    ["ペンタクルの3","Three Of Pentacles(ペンタクルの3)"],
                    ["ペンタクルの4","Four Of Pentacles(ペンタクルの4)"],
                    ["ペンタクルの5","Five Of Pentacles(ペンタクルの5)"],
                    ["ペンタクルの6","Six Of Pentacles(ペンタクルの6)"],
                    ["ペンタクルの7","Seven Of Pentacles(ペンタクルの7)"],
                    ["ペンタクルの8","Eight Of Pentacles(ペンタクルの8)"],
                    ["ペンタクルの9","Nine Of Pentacles(ペンタクルの9)"],
                    ["ペンタクルの10","Ten Of Pentacles(ペンタクルの10)"],
                    ["ペンタクルのペイジ","Page Of Pentacles(ペンタクルのペイジ)"],
                    ["ペンタクルのナイト","Knight Of Pentacles(ペンタクルのナイト)"],
                    ["ペンタクルのクイーン","Queen Of Pentacles(ペンタクルのクイーン)"],
                    ["ペンタクルのキング","King Of Pentacles(ペンタクルのキング)"],
                ),
            ),
        );
        foreach($replies as $type => $reply){
            $app_reply  =   AppReply::Create(array(
                "app_id"    =>  $app->id,
                "type"      =>  $type               ?? null,
                "name"      =>  $reply["name"]      ?? null,
                "category"  =>  $reply["category"]  ?? null,
                "mode"      =>  $reply["mode"]      ?? null,
                "query"     =>  $reply["query"]     ?? array(),
                "status"    =>  "active",
            ));
            foreach($reply["messages"] as $message){
                $app_reply->create_simple_text_message(($message[0] ?? null),($message[1] ?? "失敗"));
            }
        }
    }
}
