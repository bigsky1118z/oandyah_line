<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteLayout extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_id",
        "type",
        "target",
        "order",
        "option",
    );

    public static $targets  =   array(
        "header"    =>  "ヘッダー",
        "main"      =>  "メイン",
        "footer"    =>  "フッター",
    );

    public static $options  =   array(
        "single"    =>  array(
        ),
        "multiple"  =>  array(
            "title-1"       =>  "新着タイトル1件",
            "title-3"       =>  "新着タイトル3件",
            "title-5"       =>  "新着タイトル5件",
            "title-10"      =>  "新着タイトル10件",
            "article-1"     =>  "新着記事1件",
            "article-2"     =>  "新着記事2件",
            "article-3"     =>  "新着記事3件",
            "article-4"     =>  "新着記事4件",
            "article-5"     =>  "新着記事5件",
            "card-1"        =>  "新着カード1件",
            "card-2"        =>  "新着カード2件",
            "card-3"        =>  "新着カード3件",
            "card-4"        =>  "新着カード4件",
            "card-6"        =>  "新着カード6件(3×2列)",
            "card_title-1"  =>  "新着カード+タイトル1件",
            "card_title-2"  =>  "新着カード+タイトル2件",
            "card_title-3"  =>  "新着カード+タイトル3件",
            "card_title-4"  =>  "新着カード+タイトル4件",
            "card_title-6"  =>  "新着カード+タイトル6件(3×2列)",
        ),
        "menu"      =>  array(
            "description"  =>  "説明付き",
            "bar"          =>  "メニューバー",
        ),
        "iamge"     =>  array(
            "image-header"  =>  "ヘッダー画像",
        ),
    );

    public function page()
    {
        return $this->belongsTo(WebsitePage::class,"website_page_id");
    }

}
