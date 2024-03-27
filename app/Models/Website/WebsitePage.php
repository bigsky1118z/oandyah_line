<?php

namespace App\Models\Website;

use App\Models\Website\Page\WebsitePageContact;
use App\Models\Website\Page\WebsitePageMenu;
use App\Models\Website\Page\WebsitePageMultiple;
use App\Models\Website\Page\WebsitePageSingle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePage extends Model
{
    use HasFactory;


    protected $fillable =   array(
        "id",

        "type",
        "path",
        "title",
        "description",

        "image_thumbnail_url",
        "image_header_url",

        
        "status",
        "valid_at",
        "expired_at",
    );

    public static $types    =   array(
        "single"        =>  "単独ページ",
        "multiple"      =>  "複合ページ",
        "contact"       =>  "問い合わせページ",
        "menu"          =>  "メニューページ",
        "image"         =>  "画像ページ",
        "subdirectory"  =>  "個別ページ",
    );

    public static $regulated_path   =   array(
        "admin",
        "user",
        "guest",
        "dashboard",
        "register",
        "login",
        "logout",
        "img",
        "image",
        "css",
        "storage",
        "style.css",
        "redirect",
    );

    public static $edits    =   array(
        "user"          =>  array(
            "title"         =>  "ユーザー",
            "description"   =>  "ユーザーの登録・編集・削除などを管理します。",
        ),
        "config"        =>  array(
            "title"         =>  "設定",
            "description"   =>  "ウェブサイトのタイトルやロゴ、表示を設定します。",
        ),
        "page"          =>  array(
            "title"         =>  "ページ",
            "description"   =>  "ウェブサイトのページを設定します。",
        ),
        "image"         =>  array(
            "title"         =>  "画像管理",
            "description"   =>  "準備中",
        ),
        "style"         =>  array(
            "title"         =>  "スタイル",
            "description"   =>  "ウェブサイトのCSSを管理します。",
        ),
        "layout"        =>  array(
            "title"         =>  "レイアウト",
            "description"   =>  "トップページのレイアウト、各ページのヘッダーおよびフッターのレイアウトを管理します。",
        ),
        "membership"    =>  array(
            "title"         =>  "メンバーシップ",
            "description"   =>  "準備中",
        ),
    );

    public static $subdirectories   =   array(
        "kbox"          =>  "K BOX SYSTEM",
        "jinguji_ozora" =>  "占い師 神宮寺大空【おうえんや】",
        "pokemon"       =>  "俺たちポケモンおうえんや",
        "gluten_free"   =>  "グルテンフリーおうえんや",
        "line_api"      =>  "LINE公式アカウントおうえんや",
    );

    public static $statuses     =   array(
        "draft"     =>  "下書き",
        "private"   =>  "非公開",
        "published" =>  "公開",
    );
    
    public static $publish_statuses =   array(
        "draft"     =>  "下書き",
        "private"   =>  "非公開",
        "published" =>  "公開",
        "reserved"  =>  "公開予約",
        "expired"   =>  "公開終了",
        "error"     =>  "エラー",
    );


    public function linked_page()
    {
        $type   =   $this->type;
        switch($type){
            case "single":
                return $this->single;
                break;
            case "multiple":
                return $this->multiple;
                break;
            case "menu":
                return $this->menu;
                break;
            case "contact":
                return $this->contact;
                break;
            case "image":
                return $this->image;
                break;
            default:
                return null;
            }
    }

    public function single()
    {
        return $this->hasOne(WebsitePageSingle::class);
    }
    public function multiple()
    {
        return $this->hasOne(WebsitePageMultiple::class);
    }
    public function menu()
    {
        return $this->hasOne(WebsitePageMenu::class);
    }
    public function contact()
    {
        return $this->hasOne(WebsitePageContact::class);
    }




    public static function check_path($new_path, $path = null)
    {
        if($new_path == null){
            return false;
        }
        if(in_array($new_path, self::$regulated_path)) {
            return false;
        }
        if(in_array($new_path, array_keys(self::$subdirectories))) {
            return false;
        }
        if($new_path != $path && WebsitePage::wherePath($new_path)->exists()){
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

    public static function get_type($path)
    {
        $page_path  =   strstr($path, "/", true) ? strstr($path, "/", true) : $path;
        $type       =   null;
        if($path == "/"){
            $type   =   "top";
        }elseif($page_path && WebsitePage::wherePath($page_path)->exists()){
            $type   =    WebsitePage::wherePath($page_path)->first()->type;
        }
        return $type;
    }







    
    public function is_member()
    {
        $memberships    =   $this->memberships;
        if($memberships->isEmpty()){
            return true;
        }else{
            $user_id    =   auth()->id();
            foreach($memberships as $membership){
                if($membership->membership->users()->where("user_id",$user_id)->exists()){
                    return true;
                }
            }
        }
        return false;
    }

    public function create_single($body = null)
    {
        WebsitePageSingle::Create(array(
            "website_page_id"   =>  $this->id,
            "body"              =>  $body,
        ));
    }

    public function layouts()
    {
        return $this->hasMany(WebsiteLayout::class,"website_page_id");
    }


    public function memberships()
    {
        return $this->hasMany(WebsitePageMembership::class,"website_page_id");
    }

    public function add_membership($membership_id)
    {
        WebsitePageMembership::Create(array(
            "website_page_id"       =>  $this->id,
            "website_membership_id" => $membership_id,
        ));
    }

    public function remove_membership($membership_id)
    {
        $this->memberships()->whereWebsiteMembershipId($membership_id)->delete();
    }

    public function membership_ids()
    {
        return $this->memberships->pluck("website_membership_id")->toArray();
    }
}
