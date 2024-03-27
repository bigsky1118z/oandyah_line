<?php

namespace Database\Seeders;

use App\Models\Api\LineApiOrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // id : 1
        LineApiOrderItem::Create(array(
            "channel_name"      =>  "all",
            "code"              =>  "default001",
            "category"          =>  "価格",
            "sub_category"      =>  null,
            "name"              =>  "割引",
            "size"              =>  null,
            "material"          =>  null,
            "allergy"           =>  null,
            "square_image_url"  =>  null,
            "wide_image_url"    =>  null,
        ));

        // id : 2
        LineApiOrderItem::Create(array(
            "channel_name"      =>  "all",
            "code"              =>  "default002",
            "category"          =>  "価格",
            "sub_category"      =>  null,
            "name"              =>  "割増",
            "size"              =>  null,
            "material"          =>  null,
            "allergy"           =>  null,
            "square_image_url"  =>  null,
            "wide_image_url"    =>  null,
        ));

        // id : 3
        LineApiOrderItem::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "code"              =>  "S0001",
            "category"          =>  "占い",
            "sub_category"      =>  "お試し",
            "name"              =>  "3カード占い",
            "size"              =>  "10分",
            "material"          =>  null,
            "allergy"           =>  null,
            "square_image_url"  =>  null,
            "wide_image_url"    =>  null,
        ));

        // id : 4
        LineApiOrderItem::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "code"              =>  "S0002",
            "category"          =>  "占い",
            "sub_category"      =>  "お試し",
            "name"              =>  "太陽星座+月星座占い",
            "size"              =>  "10分",
            "material"          =>  null,
            "allergy"           =>  null,
            "square_image_url"  =>  null,
            "wide_image_url"    =>  null,
        ));

        // id : 5
        LineApiOrderItem::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "code"              =>  "S0003",
            "category"          =>  "占い",
            "sub_category"      =>  "お試し",
            "name"              =>  "ライフパスナンバー",
            "size"              =>  "10分",
            "material"          =>  null,
            "allergy"           =>  null,
            "square_image_url"  =>  null,
            "wide_image_url"    =>  null,
        ));

        // id : 6
        LineApiOrderItem::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "code"              =>  "C0001",
            "category"          =>  "占い",
            "sub_category"      =>  "標準",
            "name"              =>  "総合占い",
            "size"              =>  "60分",
            "material"          =>  array(
                "タロット"  =>  "適宜",
                "数秘術"    =>  "適宜",
                "占星術"    =>  "適宜",
            ),
            "allergy"           =>  null,
            "square_image_url"  =>  null,
            "wide_image_url"    =>  null,
        ));

        // id : 7
        LineApiOrderItem::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "code"              =>  "T0001",
            "category"          =>  "占い",
            "sub_category"      =>  "標準",
            "name"              =>  "恋愛占い(タロット)",
            "size"              =>  "30分",
            "material"          =>  array(
                "タロット"  =>  "30分",
            ),
            "allergy"           =>  null,
            "square_image_url"  =>  null,
            "wide_image_url"    =>  null,
        ));

    }
}
