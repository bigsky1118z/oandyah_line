<?php

namespace Database\Seeders;

use App\Models\Api\LineApiOrderMenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiOrderMenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiOrderMenuItem::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  1,
            "line_api_order_item_id"    =>  3,
            "price"                     =>  500,
            "code"                      =>  null,
            "category"                  =>  null,
            "sub_category"              =>  null,
            "name"                      =>  null,
            "size"                      =>  null,
            "discription"               =>  null,
            "square_image_url"          =>  null,
            "wide_image_url"            =>  null,
        ));

        LineApiOrderMenuItem::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  1,
            "line_api_order_item_id"    =>  4,
            "price"                     =>  500,
            "code"                      =>  null,
            "category"                  =>  null,
            "sub_category"              =>  null,
            "name"                      =>  null,
            "size"                      =>  null,
            "discription"               =>  null,
            "square_image_url"          =>  null,
            "wide_image_url"            =>  null,
        ));

        LineApiOrderMenuItem::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  1,
            "line_api_order_item_id"    =>  5,
            "price"                     =>  500,
            "code"                      =>  null,
            "category"                  =>  null,
            "sub_category"              =>  null,
            "name"                      =>  null,
            "size"                      =>  null,
            "discription"               =>  null,
            "square_image_url"          =>  null,
            "wide_image_url"            =>  null,
        ));

        LineApiOrderMenuItem::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  1,
            "line_api_order_item_id"    =>  6,
            "price"                     =>  10000,
            "code"                      =>  null,
            "category"                  =>  null,
            "sub_category"              =>  null,
            "name"                      =>  null,
            "size"                      =>  null,
            "discription"               =>  null,
            "square_image_url"          =>  null,
            "wide_image_url"            =>  null,
        ));

        LineApiOrderMenuItem::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  1,
            "line_api_order_item_id"    =>  6,
            "price"                     =>  5000,
            "code"                      =>  null,
            "category"                  =>  null,
            "sub_category"              =>  null,
            "name"                      =>  "総合占い（初回限定）",
            "size"                      =>  null,
            "discription"               =>  null,
            "square_image_url"          =>  null,
            "wide_image_url"            =>  null,
        ));

        LineApiOrderMenuItem::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_order_menu_id"    =>  1,
            "line_api_order_item_id"    =>  7,
            "price"                     =>  5000,
            "code"                      =>  null,
            "category"                  =>  null,
            "sub_category"              =>  null,
            "name"                      =>  null,
            "size"                      =>  null,
            "discription"               =>  null,
            "square_image_url"          =>  null,
            "wide_image_url"            =>  null,
        ));

    }
}
