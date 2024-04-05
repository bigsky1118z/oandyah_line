<?php

namespace App\Models\App;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppSend extends Model
{
    use HasFactory;
    protected $fillable =   [
        "app_id",
        "type",
        "status",

        "response_code",
        "x_line_request_id",

        "x_line_retry_key",

        "app_firend_id",
        "reply_token",
        "recipient",
        "filter",
        "limit",

        "app_message_id",


        "notification_disabled",
        "custom_aggregation_units",

        "sent_messages",
        "error_message",
        "error_details",
    ];

    protected $casts    =   [
        "notification_disabled" =>  "boolean",
        "sent_messages"         =>  "json",
        "error_details"         =>  "json",

    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
    public function friend()
    {
        return $this->belongsTo(AppFriend::class)->whereAppId($this->app->id)->first();
    }

    public function message()
    {
        return $this->belongsTo(AppMessage::class)->whereAppId($this->app->id)->first();
    }    

    public function post_bot_message()
    {
        $app        =   $this->app;
        $headers    =   array(
            "Authorization" =>  "Bearer $app->channel_access_token",
            "Content-Type"  =>  "application/json",
        );
        $data       =   array(
            "replyToken"    =>  $this->reply_token  ??  null,
            // "to"            =>  $this->friend       ?   $this->friend->friend_id    :   null,
            // "recipient"     =>  $this->recipient    ??  null,
            // "filter"        =>  $this->filter       ??  null,
            // "limit"         =>  $this->limit        ??  null,
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
            "customAggregationUnits"    =>  $this->custom_aggregation_units ?   array($this->custom_aggregation_units)  :   null,
            "notificationDisabled"      =>  $this->notification_disabled    ??  false,
        );
        $this->status   =   "C";
        $this->save();

        $endpoint   =   "https://api.line.me/v2/bot/message/" . $this->type;
        $this->status   =   "D";
        $this->save();

        $response   =   Http::withHeaders($headers)->post($endpoint, $data);
        $this->status   =   "E";
        $this->save();

        $this->response_code    =   $response->status();
        if($response->successful()){

        } else {
            $this->error_message    =   $response->get("message");
        }
        $this->save();
        
        return $response;
    }

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
