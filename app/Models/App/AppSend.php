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

        "friend_id",
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

    public function message()
    {
        return $this->belongsTo(AppMessage::class)->whereAppId($this->app->id)->first();
    }

    public function get_friend()
    {
        $friend_id  =   $this->friend_id ?? null;
        $friend     =   $friend_id
                    ?   AppFriend::updateOrCreate(array(
                            "app_id"    =>  $this->app->id,
                            "friend_id" =>  $friend_id,
                        ))
                    :   new AppFriend();
        return $friend;
    }

    public function post_bot_message()
    {
        $app        =   $this->app;
        $headers    =   array(
            "Authorization" =>  "Bearer $app->channel_access_token",
            "Content-Type"  =>  "application/json",
        );
        $data       =   array(
            "replyToken"    =>  $this->reply_token          ??  null,
            "to"            =>  $this->get_friend()->id     ??  null,
            "recipient"     =>  $this->recipient            ??  null,
            "filter"        =>  $this->filter               ??  null,
            "limit"         =>  $this->limit                ??  null,
            "messages"      =>  $this->message->messages    ??  null,
            // "messages"      =>  [
            //     array(
            //         "type"  =>  "text",
            //         "text"  =>  "興味しんしん",
            //     ),
            //     array(
            //         "type"  =>  "text",
            //         "text"  =>  "興味しんしんビーム",
            //     ),
            // ],
            "customAggregationUnits"    =>  $this->custom_aggregation_units ?   array($this->custom_aggregation_units)  :   null,
            "notificationDisabled"      =>  $this->notification_disabled    ??  false,
        );

        $endpoint               =   "https://api.line.me/v2/bot/message/" . $this->type;
        $response               =   Http::withHeaders($headers)->post($endpoint, $data);
        $this->response_code    =   $response->status();
        if($response->successful()){
            $this->sent_messages    =   $response["sentMessages"] ?? null;
        } else {
            $this->error_message    =   $response["message"];
            $this->error_details    =   $response["details"];
        }
        $this->save();
        
        return $response;
    }
}
