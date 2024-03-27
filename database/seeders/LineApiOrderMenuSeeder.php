<?php

namespace Database\Seeders;

use App\Models\Api\LineApiOrderMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiOrderMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiOrderMenu::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "code"              =>  "F0001",
            "name"              =>  "究極の未来に導く占い",
            "category"          =>  "占い",
            "sub_category"      =>  null,
            "discription"       =>  "神宮寺大空の占いの基本メニュー",
            "cover_image_url"   =>  null,
            "no_image_url"      =>  null,
            "status"            =>  "公開",
            "valid_at"          =>  null,
            "expired_at"        =>  null,
        ));
    }
}
