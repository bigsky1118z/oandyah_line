<?php

namespace App\Models\Line;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class LineFriend extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_id",
        "line_user_id",
        "status",
        "display_name",
        "language",
        "picture_url",
        "status_message",
        "naming",
    );

    public function line()
    {
        return $this->belongsTo(Line::class, "line_id");
    }

    public function name()
    {
        return $this->hasOne(LineFriendName::class);
    }

    // public function birthday()
    // {
    //     return $this->hasOne(UserBirthday::class);
    // }

    public function groups()
    {
        return $this->hasMany(LineGroupFriend::class)->whereLineId($this->line_id);
    }



    public function get_bot_profile()
    {
        $headers    =   array(
            "Authorization" => "Bearer ". $this->line->channel_access_token,
        );
        $url        =   "https://api.line.me/v2/bot/profile/" . $this->line_user_id;
        $response   =   Http::withHeaders($headers)->get($url);
        if($response->successful()){
            $this->status   =   "follow";
            isset($response["displayName"])     ?   $this->display_name     =   $response["displayName"]    :   null;
            isset($response["language"])        ?   $this->language         =   $response["language"]       :   null;
            isset($response["pictureUrl"])      ?   $this->picture_url      =   $response["pictureUrl"]     :   null;
            isset($response["statusMessage"])   ?   $this->status_message   =   $response["statusMessage"]  :   null;
        } else {
            $this->status   =   "unfollow";
        }
        $this->save();
        return $response->json();
    }

    public function get_name()
    {
        $name   =   "あなた";
        $name   =   $this->display_name ? $this->display_name : $name;
        if($this->name){
            $name   =   $this->name->nickname ? $this->name->nickname : $name;
            switch($this->name->honorific_title){
                case("Mr."):
                case("Dr."):
                    $name   =   $this->name->honorific_title . $name;
                    break;
                default:
                    $name   =   $this->name->honorific_title ? $name . $this->name->honorific_title : $name . "さん";
            }
        } else {
            $name   =   $name != "あなた"   ?   $name . "さん"  :   $name;
        }
        return $name;
    }

    public function set_name($type, $name1, $name2 = null, $name3 = null, $name4 = null)
    {
        switch($type){
            case "jp":
            case "kana":
            case "en":
                LineFriendName::updateOrCreate(
                    array(
                        "line_friend_id"    =>  $this->id,
                    ),
                    array(
                        "last_name_$type"   =>   $name1,
                        "first_name_$type"  =>   $name2,
                        "middle_name_$type" =>   $name3,
                        "maiden_name_$type" =>   $name4,
                    )
                );
                break;
            case "nickname":
            case "honorific_title":
                LineFriendName::updateOrCreate(
                    array(
                        "line_friend_id"    =>  $this->id,
                    ),
                    array(
                        "$type"             =>   $name1,
                    )
                );
                break;
            }
    }

}
