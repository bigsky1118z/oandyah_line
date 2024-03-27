<?php

namespace Database\Seeders;

use App\Models\Api\LineApiOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiOrder::Create(array(
            "channel_name"                  =>  "jinguji_ozora",
            "line_api_order_menu_id"        =>  1,
            "line_api_user_id"              =>  1,
            "table"                         =>  null,
            "line_api_order_menu_item_id"   =>  1,
            "price"                         =>  500,
            "quantity"                      =>  1,
            "status"                        =>  "未提供",
        ));

        LineApiOrder::Create(array(
            "channel_name"                  =>  "jinguji_ozora",
            "line_api_order_menu_id"        =>  1,
            "line_api_user_id"              =>  1,
            "table"                         =>  null,
            "line_api_order_menu_item_id"   =>  2,
            "price"                         =>  500,
            "quantity"                      =>  2,
            "status"                        =>  "未提供",
        ));

        LineApiOrder::Create(array(
            "channel_name"                  =>  "jinguji_ozora",
            "line_api_order_menu_id"        =>  1,
            "line_api_user_id"              =>  1,
            "table"                         =>  null,
            "line_api_order_menu_item_id"   =>  3,
            "price"                         =>  500,
            "quantity"                      =>  3,
            "status"                        =>  "未提供",
        ));
    }
}
