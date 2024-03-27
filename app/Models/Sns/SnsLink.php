<?php

namespace App\Models\Sns;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnsLink extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "sns_id",
        "type",
        "value",
        "title",
        "description",
        "image_url_thumbnail",
        "image_url_header",
        "active",
        "order",
    );

    protected $casts    =   array(
        "active"    =>  "boolean",
    );

    public static $types    =   array(
        "x"             =>  "X",
        "instagram"     =>  "Instagram",
        "tiktok"        =>  "TikTok",
        "youtube"       =>  "YouTube",
        "line"          =>  "個人LINE",
        "line_official" =>  "LINE公式アカウント",
        "website"       =>  "ウェブサイト",
    );

    public function url()
    {
        $url    =   "";
        switch($this->type){
            case("x"):
            case("twitter"):
                $url    =   "https://twitter.com/" . $this->value;
                break;
            case("instagram"):
                $url    =   "https://www.instagram.com/" . $this->value;
                break;
            case("tiktok"):
                $url    =   "https://www.tiktok.com/@" . $this->value;
                break;
            case("line_official"):
                $url    =   "https://lin.ee/" . $this->value;
                break;
            case("youtube"):
                $url    =   "https://www.youtube.com/@" . $this->value;
            case("website"):
                $url    =   $this->value;
                break;
        }
        return $url;
    }

    public function account()
    {
        $account    =   "";
        switch($this->type){
            case("x"):
            case("twitter"):
            case("instagram"):
            case("tiktok"):
                $account    =   "@" . $this->value;
                break;
            case("website"):
                $account    =   $this->value;
                break;
        }
        return $account;
    }

    public function image_url_logo(){
        if (file_exists(public_path("storage/sns/logo/" . $this->type . ".png"))) {
            return "/storage/sns/logo/$this->type.png";
        } else {
            return "/storage/sns/icon/default.png";
        }
    }

}