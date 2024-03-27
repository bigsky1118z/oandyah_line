<?php

namespace Database\Seeders;

use App\Models\Api\LineApiMessage;
use App\Models\Api\LineApiReply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiReply::Create(array(
            "channel_name"          =>  "jinguji_ozora",
            "name"                  =>  "新規フォロー",
            "type"                  =>  "follow",
            "active"                =>  true,
            "condition"             =>  "follow",
            "line_api_message_1_id" =>  LineApiMessage::whereChannelName("jinguji_ozora")->whereCategory("自動返信")->whereSubCategory("デフォルト")->whereName("新規フォロー")->first()->id,
            "line_api_message_2_id" =>  null,
            "line_api_message_3_id" =>  null,
            "line_api_message_4_id" =>  null,
            "line_api_message_5_id" =>  null,
            "notification_disabled" =>  false,
        ));

        LineApiReply::Create(array(
            "channel_name"          =>  "jinguji_ozora",
            "name"                  =>  "ブロック解除",
            "type"                  =>  "follow",
            "active"                =>  true,
            "condition"             =>  "refollow",
            "line_api_message_1_id" =>  LineApiMessage::whereChannelName("jinguji_ozora")->whereCategory("自動返信")->whereSubCategory("デフォルト")->whereName("ブロック解除")->first()->id,
            "line_api_message_2_id" =>  null,
            "line_api_message_3_id" =>  null,
            "line_api_message_4_id" =>  null,
            "line_api_message_5_id" =>  null,
            "notification_disabled" =>  false,
        ));


        LineApiReply::Create(array(
            "channel_name"          =>  "jinguji_ozora",
            "name"                  =>  null,
            "type"                  =>  "postback",
            "active"                =>  true,
            "condition"             =>  "action=order&item=any&value=list",
            "line_api_message_1_id" =>  LineApiMessage::whereChannelName("jinguji_ozora")->whereCategory("自動返信")->whereSubCategory("オーダー")->whereName("リスト")->first()->id,
            "line_api_message_2_id" =>  null,
            "line_api_message_3_id" =>  null,
            "line_api_message_4_id" =>  null,
            "line_api_message_5_id" =>  null,
            "notification_disabled" =>  false,
        ));

        LineApiReply::Create(array(
            "channel_name"          =>  "jinguji_ozora",
            "name"                  =>  null,
            "type"                  =>  "postback",
            "active"                =>  true,
            "condition"             =>  "action=order&item=any&value=confirm",
            "line_api_message_1_id" =>  LineApiMessage::whereChannelName("jinguji_ozora")->whereCategory("自動返信")->whereSubCategory("オーダー")->whereName("確認")->first()->id,
            "line_api_message_2_id" =>  null,
            "line_api_message_3_id" =>  null,
            "line_api_message_4_id" =>  null,
            "line_api_message_5_id" =>  null,
            "notification_disabled" =>  false,
        ));

        LineApiReply::Create(array(
            "channel_name"          =>  "jinguji_ozora",
            "name"                  =>  null,
            "type"                  =>  "postback",
            "active"                =>  true,
            "condition"             =>  "action=order&item=any&value=order",
            "line_api_message_1_id" =>  LineApiMessage::whereChannelName("jinguji_ozora")->whereCategory("自動返信")->whereSubCategory("オーダー")->whereName("注文")->first()->id,
            "line_api_message_2_id" =>  null,
            "line_api_message_3_id" =>  null,
            "line_api_message_4_id" =>  null,
            "line_api_message_5_id" =>  null,
            "notification_disabled" =>  false,
        ));

    }
}
