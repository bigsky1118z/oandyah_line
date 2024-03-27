<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteConfig extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "name",
        "value",
    );


    public static function get_config($name)
    {
        return WebsiteConfig::whereName($name)->exists() ? WebsiteConfig::whereName($name)->first()->value : null;
    }

    public static function set_config($name, $value)
    {
        $config =   WebsiteConfig::updateOrCreate(array(
            "name"      =>  $name,
        ),array(
            "value"     =>  $value,
        ));
        return $config;
    }

    public static function configs()
    {
        $configs    =   array();
        foreach(self::$defaults as $key => $default){
            $config         =   WebsiteConfig::whereName($key)->exists()
                                ? WebsiteConfig::whereName($key)->first()
                                : WebsiteConfig::set_config($key, $default);
            $configs[$key]  =   $config->value;
        }
        return $configs;
    }
    public static $defaults =   array(
        "title"                     =>  "O&Yah",
        "header_logo_title"         =>  "title",
        "display_header_logo_title" =>  "all",
        "display_header_image"      =>  "all",
        "membership_page"           =>  "title",
        "description"               =>  <<<EOF
                                        Hello world!
                                        this website is a sumple page.
                                        EOF,
        "layout_single"             =>  "default",
        "layout_multiple"           =>  "default",
        "layout_multiple_article"   =>  "default",
        "layout_menu"               =>  "default",
    );




    public static $header_logo_titles  =   array(
        "none"                  =>  "非表示",
        "title"                 =>  "タイトル",
        "title-fixed"           =>  "タイトル（固定）",
        "title-left"            =>  "タイトル（左寄せ）",
        "title-fixed-left"      =>  "タイトル（固定＋左寄せ）",
        "logo"                  =>  "ロゴ",
        "logo-fixed"            =>  "ロゴ（固定）",
        "logo-left"             =>  "ロゴ（左寄せ）",
        "logo-fixed-left"       =>  "ロゴ（固定＋左寄せ）",
        "logo-title"            =>  "ロゴ＋タイトル",
        "logo-title-fixed"      =>  "ロゴ＋タイトル（固定）",
        "logo-title-left"       =>  "ロゴ＋タイトル（左寄せ）",
        "logo-title-fixed-left" =>  "ロゴ＋タイトル（固定＋左寄せ）",
    );

    public static $is_displays  =   array(
        "all"           =>  "すべてのページ",
        "top"           =>  "トップページのみ",
        "top-single"    =>  "トップページ＋単独ページ",
    );

    public static $membership_pages =   array(
        "title" =>  "タイトルのみ表示",
        "skip"  =>  "非表示",
    );

    public static $images   =   array(
        "logo"      =>  "logo.png",
        "favicon"   =>  "favicon.ico",
        "no_image"  =>  "no_image.png",
    );


    public static function is_display($name, $path)
    {
        $type   =   WebsitePage::get_type($path);
        $value  =   WebsiteConfig::whereName("display_$name")->exists() ? WebsiteConfig::whereName("display_$name")->first()->value : "";
        if($type && ($value == "all" || in_array($type, explode("-",$value)))){
            return true;
        }else {
            return false;
        }
    }

    // public static function is_display_header_logo_title($path)
    // {
    //     $type   =   WebsitePage::get_type($path);
    //     $value  =   WebsiteConfig::whereName("display_header_logo_title")->exists() ? WebsiteConfig::whereName("display_header_logo_title")->first()->value : "";
    //     if($type && ($value == "all" || in_array($type, explode("-",$value)))){
    //         return true;
    //     }else {
    //         return false;
    //     }
    // }

    // public static function is_display_header_image($path)
    // {
    //     $type   =   WebsitePage::get_type($path);
    //     $value  =   WebsiteConfig::whereName("display_header_image")->exists() ? WebsiteConfig::whereName("display_header_image")->first()->value : "";
    //     if($type && ($value == "all" || in_array($type, explode("-",$value)))){
    //         return true;
    //     }else {
    //         return false;
    //     }
    // }

}
