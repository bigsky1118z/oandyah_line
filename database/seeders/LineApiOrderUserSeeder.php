<?php

namespace Database\Seeders;

use App\Models\Api\LineApiOrderUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiOrderUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiOrderUser::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  "1",
            "line_api_user_id"          =>  "1",
            "name"                      =>  "table",
            "value"                     =>  "1",
        ));

        LineApiOrderUser::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  "1",
            "line_api_user_id"          =>  "1",
            "name"                      =>  "rank",
            "value"                     =>  "100",
        ));

        LineApiOrderUser::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  "1",
            "line_api_user_id"          =>  "1",
            "name"                      =>  "point",
            "value"                     =>  "1000",
        ));
    }
}
