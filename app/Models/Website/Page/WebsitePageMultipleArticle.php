<?php

namespace App\Models\Website\Page;

use App\Http\Controllers\WebsitePageMultipleArticleController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageMultipleArticle extends Model
{
    use HasFactory;
    
    protected $fillable =   array(
        "website_page_multiple_id",
        "path",
        "title",
        "body",

        "image_thumbnail_url",
        "image_header_url",

        "status",
        "valid_at",
        "expired_at",
    );

    public static $publish_statuses =   array(
        "draft"     =>  "下書き",
        "private"   =>  "非公開",
        "published" =>  "公開",
        "reserved"  =>  "公開予約",
        "expired"   =>  "公開終了",
        "error"     =>  "エラー",
    );

    public static function check_path($new_path, $path = null)
    {
        if($new_path == null){
            return false;
        }
        if($new_path != $path && WebsitePageMultipleArticle::wherePath($new_path)->exists()){
            return false;
        }
        return true;
    }


    public function is_published($type = null)
    {
        $status =   $this->status;
        $result =   "error";
        if(in_array($status, array("draft", "private"))) {
            $result =   $status;
        }
        if(in_array($status, array("published"))){
            $valid_at   =   $this->valid_at;
            $expired_at =   $this->expired_at;
            $present_at =   date("Y-m-d H:i:s");
            if($valid_at == null) {
                $result =   "draft";
            }
            if($valid_at != null) {
                if($expired_at == null) {
                    $result =   $valid_at <= $present_at ? "published" : "reserved";
                }
                if($expired_at != null) {
                    if($valid_at <= $present_at && $present_at < $expired_at) {
                        $result =   "published";
                    }
                    if($valid_at > $present_at) {
                        $result =   "reserved";
                    }
                    if($present_at >= $expired_at) {
                        $result =   "expired";
                    }
                }
            }
        }
        if($type == "jp"){
            if(isset(self::$publish_statuses[$result])){
                return self::$publish_statuses[$result];
            }
        }
        return $result;
    }

    public function multiple()
    {
        return $this->belongsTo(WebsitePageMultiple::class, "website_page_multiple_id");
    }
}
