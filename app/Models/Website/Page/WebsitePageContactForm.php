<?php

namespace App\Models\Website\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageContactForm extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_contact_id",
        "active",
        "name",
        "title",
        "type",
        "required",
        "description",
        "order",
    );

    protected $casts    =   array(
        "active"    =>  "boolean",
        "required"  =>  "boolean",
    );

    public static $form_values    =   array(
        "email"         =>  array(
            "type"  => "email",
            "title" => "メールアドレス",
        ),
        "name"          =>  array(
            "type"  => "text",
            "title" => "名前",
        ),
        "nickname"      =>  array(
            "type"  => "text",
            "title" => "ニックネーム",
        ),
        "age"           =>  array(
            "type"  => "number",
            "title" => "年齢",
        ),
        "address"       =>  array(
            "type"  => "text",
            "title" => "住所",
        ),
        "message"       =>  array(
            "type"  => "textarea",
            "title" => "問い合わせ",
        ),
        "impression"    =>  array(
            "type"  => "textarea",
            "title" => "感想",
        ),
        "agreement"     =>  array(
            "type"  => "checkbox",
            "title" => "同意",
        ),
    );
}
