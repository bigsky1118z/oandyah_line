<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class LineApiUser extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "channel_name",
        "line_user_id",
        "registed_name",
        "honorific",
        "name_to_identify",
        "memo",
    );

    public function channel()
    {
        return $this->hasOne(LineApiChannel::class, "channel_name", "channel_name");
    }

    public function line_api_events()
    {
        return $this->hasMany(LineApiEvent::class)->whereChannelName($this->channel_name);
    }

    public function line_api_event_attendances()
    {
        return $this->hasMany(LineApiEventAttendance::class)->whereChannelName($this->channel_name);
    }


    public function nickname()
    {
        $nickname   =   "";
        $this->display_name ? $nickname = $this->display_name : null;
        $this->registed_name ? $nickname = $this->registed_name : null;
        $honorific  =   "";
        $this->honorific ? $honorific = $this->honorific : null;
        in_array($honorific,array("マエストロ" ,"Mr.","Mrs.", "Dr.")) ? $nickname = $honorific . $nickname : $nickname = $nickname . $honorific;
        return  $nickname;
    }

    public static $honorifics   =   array(
        "", "さん", "くん", "君", "ちゃん", "様", "先生", "マエストロ", "Mr.", "Mrs.", "Dr.",
    );

    public function get_present_profile()
    {
        $headers    =   array(
            "Authorization" => "Bearer " . $this->channel->access_token,
        );
        $response   =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/profile/$this->line_user_id");
        if($response->successful()){
            $this->follow   =   "follow";
            $profile    =   $response->json();
            isset($profile["displayName"])      ?   $this->display_name     =   $profile["displayName"]     :   null;
            isset($profile["language"])         ?   $this->language         =   $profile["language"]        :   null;
            isset($profile["pictureUrl"])       ?   $this->picture_url      =   $profile["pictureUrl"]      :   null;
            isset($profile["statusMessage"])    ?   $this->status_message   =   $profile["statusMessage"]   :   null;
            $this->save();
        }else{
            $this->follow   =   "unfollow";
            $this->save();
        }
    }

}
