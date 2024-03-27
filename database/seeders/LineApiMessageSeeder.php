<?php

namespace Database\Seeders;

use App\Models\Api\LineApiMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "デフォルト",
            "name"          =>  "新規フォロー",
            "status"        =>  "デフォルト",
            "display"       =>  "表示",

            "type"          =>  "text",
            "text"          =>  "{name}フォローありがとうございます。{you}に出会えて幸せです。",
        ));

        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "デフォルト",
            "name"          =>  "新規フォロー[時間指定]",
            "status"        =>  "デフォルト",
            "display"       =>  "表示",

            "type"          =>  "text",
            "text"          =>  "{name}フォローありがとうございます。この時間だけの限定メッセージ。",
        ));


        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "デフォルト",
            "name"          =>  "ブロック解除",
            "status"        =>  "デフォルト",
            "display"       =>  "表示",

            "type"          =>  "text",
            "text"          =>  "{name}ブロック解除、ありがとうございます。これからまたよろしくお願いします。",
        ));

        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "デフォルト",
            "name"          =>  "ブロック解除[時間指定]",
            "status"        =>  "デフォルト",
            "display"       =>  "表示",

            "type"          =>  "text",
            "text"          =>  "{name}ブロック解除、ありがとうございます。この時間だけの限定メッセージ。",
        ));

        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "ワンタイム",
            "sub_category"  =>  null,
            // "name"          =>  null,
            "type"          =>  "text",
            "text"          =>  "default message for message(new)",
        ));

        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "出席確認",
            "name"          =>  "出席確認→出席",
            "type"          =>  "text",
            "text"          =>  "default message for postback action=attendance",
        ));        

        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "オーダー",
            "name"          =>  "リスト",
            "type"          =>  "text",
            "text"          =>  "リストを出すよ。{name} {menu_name} {display_name} {price}",
        ));        

        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "オーダー",
            "name"          =>  "確認",
            "type"          =>  "text",
            "text"          =>  "確認を出すよ。{name} {menu_name} {display_name} {price}",
        ));        
        LineApiMessage::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "category"      =>  "自動返信",
            "sub_category"  =>  "オーダー",
            "name"          =>  "注文",
            "type"          =>  "text",
            "text"          =>  "注文を出すよ。{name} {menu_name} {display_name} {price}",
        ));        

    }
}
