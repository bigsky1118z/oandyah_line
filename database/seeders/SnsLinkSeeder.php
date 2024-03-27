<?php

namespace Database\Seeders;

use App\Models\Sns\Sns;
use App\Models\Sns\SnsLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SnsLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sns    =   Sns::whereName("bigsky1118")->first();
        if($sns) {
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "x",
                "title"                 =>  "X(旧Twitter)",
                "value"                 =>  "ozora_the_wink",
                "description"           =>  "情報発信してます",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "instagram",
                "title"                 =>  "インスタグラム",
                "value"                 =>  "bigsky1118",
                "description"           =>  "写真を公開してます",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "tiktok",
                "title"                 =>  null,
                "value"                 =>  "bigsky1118",
                "description"           =>  null,
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "youtube",
                "title"                 =>  "YouTuberです",
                "value"                 =>  "bigsky1118",
                "description"           =>  "金の盾目指します",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "website",
                "title"                 =>  "公式サイトです",
                "value"                 =>  "/",
                "description"           =>  "すけじゅーるはこちらから",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "line",
                "title"                 =>  "LINEです",
                "value"                 =>  "ozr9",
                "description"           =>  "連絡はこちらから",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "line_official",
                "title"                 =>  "LINE公式アカウントです",
                "value"                 =>  "bigsky1118",
                "description"           =>  "おともだち登録お願いします",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
        }
        $sns    =   Sns::whereName("jinguji_ozora")->first();
        if($sns) {
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "tiktok",
                "title"                 =>  "TikTok",
                "value"                 =>  "jinguji_ozora",
                "description"           =>  "情報発信してます",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "instagram",
                "title"                 =>  "インスタグラム",
                "value"                 =>  "jinguji_ozora",
                "description"           =>  "写真を公開してます",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  false,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "x",
                "title"                 =>  "神宮寺大空公式X",
                "value"                 =>  "jinguji_ozora",
                "description"           =>  "情報発信してます",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  false,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "youtube",
                "title"                 =>  "神宮寺大空【おうえんや占い師】",
                "value"                 =>  "jinguji_ozora",
                "description"           =>  "神宮寺大空の公式YouTubeチャンネルです。",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  false,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "website",
                "title"                 =>  "神宮寺大空【おうえんや占い師】",
                "value"                 =>  "/jinguji_ozora",
                "description"           =>  "神宮寺大空の公式ホームページです。",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "line_official",
                "title"                 =>  "LINE公式アカウント「神宮寺大空」",
                "value"                 =>  "5nsvSzV",
                "description"           =>  "神宮寺大空のLINE公式アカウントです。",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));

        }
        $sns    =   Sns::whereName("shinzawa_nao")->first();
        if($sns) {
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "x",
                "title"                 =>  null,
                "value"                 =>  "_shinshin_48",
                "description"           =>  "新澤菜央さんのX公式アカウント",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "instagram",
                "title"                 =>  null,
                "value"                 =>  "_shinshin_48",
                "description"           =>  "新澤菜央さんのInstagram公式アカウント",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "tiktok",
                "title"                 =>  null,
                "value"                 =>  "_shinshin_48",
                "description"           =>  "新澤菜央さんのTikTok公式アカウント",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
            SnsLink::Create(array(
                "sns_id"                =>  $sns->id,
                "type"                  =>  "website",
                "title"                 =>  "しんしんの同棲ルーム",
                "value"                 =>  "https://shinzawanao-rooms.fanpla.jp/",
                "description"           =>  "新澤菜央さんの公式ファンクラブサイト",
                "image_url_thumbnail"   =>  null,
                "image_url_header"      =>  null,
                "active"                =>  true,
                "order"                 =>  SnsLink::whereSnsId($sns->id)->count()+1,
            ));
        }
    }
}
