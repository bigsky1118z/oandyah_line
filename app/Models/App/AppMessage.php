<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppMessage extends Model
{
    use HasFactory;

    static function post_bot_message_reply($app, $reply_token)
    {
        $headers    =   array(
            "Authorization" =>  "Bearer $app->channel_access_token",
            "Content-Type"  =>  "application/json",
        );        
        $data       =   array(
            "replyToken"    =>  $reply_token,
            "messages"      =>  [
                array(
                    "type"  =>  "text",
                    "text"  =>  "興味しんしん",
                ),
                array(
                    "type"  =>  "text",
                    "text"  =>  "興味しんしんビーム",
                ),
            ],
        );
        $url        =   "https://api.line.me/v2/bot/message/reply";
        $response   =   Http::withHeaders($headers)->post($url, $data);
        return $response;
    }
}
