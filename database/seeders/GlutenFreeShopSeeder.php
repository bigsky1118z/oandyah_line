<?php

namespace Database\Seeders;

use App\Models\GlutenFree\Shop\GlutenFreeShop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlutenFreeShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shop   =   GlutenFreeShop::Create(array(
            "name"          =>  "トムハナの木",
            "kana"          =>  "とむはなのき",
            "prefecture"    =>  "石川県",
            "city"          =>  "金沢市",
            "town"          =>  "有松2-10-19",
            "other"         =>  "",
        ));
        $shop->set_link("instagram","トムハナの木","tomuhana_no_ki");
        $shop->set_link("website","トムハナの木","https://tomuhana.net/");

        $shop   =   GlutenFreeShop::Create(array(
            "name"          =>  "crepe aimer",
            "kana"          =>  "くれーぷえめ",
            "prefecture"    =>  "大阪府",
            "city"          =>  "大阪市中央区",
            "town"          =>  "大手通1-2-1",
            "other"         =>  "三谷ビル1F",
        ));
        $shop->set_contact("tel","電話","06-6943-0333");
        $shop->set_link("instagram","クレープエメ","crepeaimer");
        $shop->set_link("facebook","クレープエメ-crepe aimer","crepe.aimer");


        $shop   =   GlutenFreeShop::Create(array(
            "name"          =>  "手しごとうどん工房 はちまん",
            "kana"          =>  "てしごとうどんこうぼうはちまん",
            "prefecture"    =>  "大阪府",
            "city"          =>  "堺市西区",
            "town"          =>  "浜寺石津町西4-14-1",
            "other"         =>  "",
        ));
        $shop->set_contact("tel","電話","072-245-5771");
        $shop->set_link("instagram","米粉うどん🌾大阪堺∣手しごとうどん工房はちまん","komekoudon.hachiman");
        $shop->set_link("website","米粉専門店米粉うどん店/大阪堺","https://hachiman8.wixsite.com/hachiman?gclid=Cj0KCQjw9MCnBhCYARIsAB1WQVVzcdHc6il3dLlefDHqo8T2mNuzW-s1k9i0SmZ1aRvl7s9Jp2Vf9n8aAjhxEALw_wcB");
    }

}
