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
        "line_user_id",
        "basic_id",
        "display_name",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",
    ];

    public function get_profile()
    {
        $headers    =   array(
            "Authorization" =>  "Bearer $this->channel_access_token",
        );
        $url        =   "https://api.line.me/v2/profile";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response;
    }

    static function post_oauth_verify_channel_access_token($channel_access_token)
    {
        $headers    =   array(
            "Content-Type"  =>  "application/x-www-form-urlencoded",
        );
        // $data       =   array(
        //     "access_token"  =>  urlencode($channel_access_token),
        // );
        // $data       =   urlencode("access_token=$channel_access_token");
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