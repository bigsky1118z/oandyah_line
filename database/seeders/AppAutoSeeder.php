<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppAuto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppAutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app    =   App::whereName("gluten_free")->first();
        $auto   =   AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "フォロー",
        ),array(
            "type"              =>  "follow",
            "priority"          =>  1,
            "app_message_id"    =>  1,
        ));
        $auto->set_default();

        $auto   =   AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "メッセージ自動応答",
            "type"      =>  "message",
        ),array(
            "priority"          =>  1,
            "app_message_id"    =>  2,
        ));
        $auto->set_default();

        $auto   =   AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "ポストバック自動応答",
            "type"      =>  "postback",
        ),array(
            "priority"          =>  1,
            "app_message_id"    =>  2,
        ));
        $auto->set_default();

        $auto   =   AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "元気づけるとき用",
            "type"      =>  "message",
            "condition" =>  array(
                "match"     =>  "exact_match",
                "keyword"   =>  "しんしん",
            ),
        ),array(
            "priority"          =>  2,
            "app_message_id"    =>  3,
        ));
        $auto   =   AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "元気づけるとき用",
            "type"      =>  "message",
            "condition" =>  array(
                "match"     =>  "partial_match",
                "keyword"   =>  "しんどい",
            ),
        ),array(
            "priority"          =>  2,
            "app_message_id"    =>  3,
        ));

    }
}
