<?php

namespace Database\Seeders;

use App\Models\Api\LineApiEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiEvent::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "category"          =>  "サンプル",
            "sub_category"      =>  "サンプル",
            "event_name"        =>  "第一回サンプルイベント",
            "schedule_name"     =>  "メイン",
            "discription"       =>  "サンプルです",
            "cover_image_url"   =>  null,
            "no_image_url"      =>  null,
            "status"            =>  "公開",
            "organizer"         =>  "神宮寺大空",
            "place"             =>  "大阪",
            "address"           =>  "大阪府東大阪市長田西6-1-36",
            "price"             =>  5000,
            "open_at"           =>  "2023-07-20 17:00:00",
            "start_at"          =>  "2023-07-20 18:00:00",
            "end_at"            =>  "2023-07-20 20:00:00",
            "close_at"          =>  "2023-07-20 21:00:00",
            "count"             =>  true,
            "user_groups"       =>  null,
        ));

        LineApiEvent::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "category"          =>  "サンプル",
            "sub_category"      =>  "サンプル",
            "event_name"        =>  "第一回サンプルイベント",
            "schedule_name"     =>  "二次会",
            "discription"       =>  "サンプルです",
            "cover_image_url"   =>  null,
            "no_image_url"      =>  null,
            "status"            =>  "公開",
            "organizer"         =>  "神宮寺大空",
            "place"             =>  "大阪",
            "address"           =>  "大阪府大阪市東成区神路4-1-25",
            "price"             =>  5000,
            "open_at"           =>  "2023-07-20 21:00:00",
            "start_at"          =>  "2023-07-20 21:30:00",
            "end_at"            =>  "2023-07-20 23:30:00",
            "close_at"          =>  "2023-07-21 00:00:00",
            "count"             =>  true,
            "user_groups"       =>  null,
        ));

        LineApiEvent::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "category"          =>  "サンプル",
            "sub_category"      =>  "サンプル",
            "event_name"        =>  "第一回サンプルイベント",
            "schedule_name"     =>  "アンケート",
            "discription"       =>  "アンケートです",
            "cover_image_url"   =>  null,
            "no_image_url"      =>  null,
            "status"            =>  "公開",
            "organizer"         =>  "神宮寺大空",
            "place"             =>  null,
            "address"           =>  null,
            "price"             =>  null,
            "open_at"           =>  null,
            "start_at"          =>  null,
            "end_at"            =>  null,
            "close_at"          =>  null,
            "count"             =>  false,
            "user_groups"       =>  null,
        ));

        LineApiEvent::Create(array(
            "channel_name"      =>  "kozu-62-3-8",
            "category"          =>  "同窓会",
            "sub_category"      =>  "全員",
            "event_name"        =>  "2023年度同窓会",
            "schedule_name"     =>  "1次会",
            "discription"       =>  "同窓会の1次会です",
            "cover_image_url"   =>  null,
            "no_image_url"      =>  null,
            "status"            =>  "公開",
            "organizer"         =>  "高津62期3年8組同窓会委員",
            "place"             =>  null,
            "address"           =>  null,
            "price"             =>  null,
            "open_at"           =>  null,
            "start_at"          =>  null,
            "end_at"            =>  null,
            "close_at"          =>  null,
            "count"             =>  true,
            "user_groups"       =>  null,
        ));

    }
}
