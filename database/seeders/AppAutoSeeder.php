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
        AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "フォロー",
        ),array(
            "type"              =>  "follow",
            "priority"          =>  1,
            "app_message_id"    =>  1,
        ));

        AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "メッセージ自動応答",
            "type"      =>  "message",
        ),array(
            "priority"          =>  1,
            "app_message_id"    =>  2,
        ));

        AppAuto::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "name"      =>  "ポストバック自動応答",
            "type"      =>  "postback",
        ),array(
            "priority"          =>  1,
            "app_message_id"    =>  2,
        ));
    }
}
