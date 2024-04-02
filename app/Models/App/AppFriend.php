<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppFriend extends Model
{
    use HasFactory;
    protected $fillable = [
        "app_id",
        "friend_id",
        "status",
        "display_name",
        "language",
        "picture_url",
        "status_message",
    ];

    public function get_name()
    {
        $name   =   $this->friend_id;
        $name   =   $this->display_name ?? $name;
        return $name;
    }

    public function latest()
    {
        $response   =   $this->get_bot_profile_friend($this->id);
        if($response->successful()){
            $this->status           =   "follow";
            $this->display_name     =   $response["displayName"]    ??  $this->display_name;
            $this->language         =   $response["language"]       ??  $this->language;
            $this->picture_url      =   $response["pictureUrl"]     ??  $this->picture_url;
            $this->status_message   =   $response["statusMessage"]  ??  $this->status_message;
        } else {
            $this->status           =   "unfollow";
        }
        $this->save();
        return $this;
    }

    public function get_bot_profile_friend($friend_id)
    {
        $headers    =   array(
            "Authorization" =>  "Bearer $this->channel_access_token",
            "Content-Type"  =>  "application/json",
        );
        $url        =   "https://api.line.me/v2/bot/profile/$friend_id";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response;
    }

}
