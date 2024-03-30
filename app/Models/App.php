<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class App extends Model
{
    use HasFactory;

    protected $fillable =   [
        "name",
        "channel_access_token",
        "user_id",
        "basic_id",
        "display_name",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",
    ];

    public function latest()
    {
        $channel_access_token       =   $this->channel_access_token;
        $info                       =   $this->get_bot_info($channel_access_token);
        $this->user_id              =   $info["userId"]         ?? $this->user_id;
        $this->basic_id             =   $info["basicId"]        ?? $this->basic_id;
        $this->display_name         =   $info["displayName"]    ?? $this->display_name;
        $this->picture_url          =   $info["pictureUrl"]     ?? $this->picture_url;
        $this->chat_mode            =   $info["chatMode"]       ?? $this->chat_mode;
        $this->mark_as_read_mode    =   $info["markAsReadMode"] ?? $this->mark_as_read_mode;
        $this->save();
    }

    // bot
    static function get_bot_info($channel_access_token)
    {
        $headers    =   array(
            "Authorization" =>  "Bearer $channel_access_token",
        );
        $url        =   "https://api.line.me/v2/bot/info";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response;
    }


    // channel access token
    static function post_oauth_verify_channel_access_token($channel_access_token)
    {
        $data       =   array(
            "access_token"  =>  $channel_access_token,
        );
        $url        =   "https://api.line.me/v2/oauth/verify";
        $response   =   Http::asForm()->post($url, $data);
        return $response;
    }

    static function put_bot_channel_webhook_endpoint($channel_access_token, $app_name)
    {
        $endpoint   =   "https://oandyah.com/app/$app_name";
        $headers    =   array(
            "Authorization" =>  "Bearer $channel_access_token",
            "Content-Type"  =>  "application/json",
        );
        $data       =   array(
            "endpoint"      =>  $endpoint,
        );
        $url        =   "https://api.line.me/v2/bot/channel/webhook/endpoint";
        $response   =   Http::withHeaders($headers)->put($url, $data);
        return $response;
    }

}