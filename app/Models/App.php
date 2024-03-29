<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class App extends Model
{
    use HasFactory;

    protected $fillable =   [
        "app_name",
        "channel_access_token",
        "line_user_id",
        "basic_id",
        "display_name",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",
    ];

    public function get_app($app_name)
    {
        return App::whereAppName($app_name)->first();
    }

    static function get_bot_channel_webhook_endpoint($channel_access_token)
    {
        $headers    =   array(
            "Authorization" => "Bearer $channel_access_token",
            "Content-Type"  =>  "application/json",
        );
        $url        =   "https://api.line.me/v2/bot/channel/webhook/endpoint";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response;
    }


    public function put_bot_channel_webhook_endpoint($app_name)
    {
        $endpoint   =   "https://oandyah.com/$app_name/webhook";
        $headers    =   array(
            "Authorization" => "Bearer ". $this->channel_access_token,
            "Content-Type"  =>  "application/json",
        );
        $data       =   array(
            "endpoint"  =>  $endpoint,
        );
        $url        =   "https://api.line.me/v2/bot/channel/webhook/endpoint";
        $response   =   Http::withHeaders($headers)->put($url, $data);
        return $response;
    }

}