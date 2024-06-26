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
        "id",
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



        "notification_disabled",
        "custom_aggregation_units",
        "messages",

        "sent_messages",
        "error_message",
        "error_details",
    ];

    protected $casts    =   [
        "notification_disabled" =>  "boolean",
        "messages"              =>  "json",
        "sent_messages"         =>  "json",
        "error_details"         =>  "json",

    ];

    public function app()
    {
        return $this->belongsTo(App::class);
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
        $friend     =   $this->get_friend();
        $messages   =   $this->messages ??  array();
        $messages   =   $this->convert_messages($messages, $friend);
        $data       =   array(
            "replyToken"                =>  $this->reply_token              ??  null,
            "to"                        =>  $friend->id                     ??  null,
            "recipient"                 =>  $this->recipient                ??  null,
            "filter"                    =>  $this->filter                   ??  null,
            "limit"                     =>  $this->limit                    ??  null,
            "messages"                  =>  $messages                       ??  null,
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

    static function convert_messages($messages) {
        $messages  =   $messages ?? array();
        $messages  =   array_filter($messages,fn($area)=>self::validate_area($area));
        $messages  =   array_values($messages);
        return $messages;
    }
    static function validate_message($message)
    {
        $validation =   true;
        $validation =   $validation ? ($message["type"] ?? null) != null    : $validation;
        return $validation;
    }



    // static function convert_messages($messages,$friend = null)
    // {
    //     $name       =   $friend->display_name . "さん" ?? "あなた";
    //     $messages   =   $messages->map(function($message) use($name) {
    //         $type   =   $message["type"]    ??  null;
    //         switch($type){
    //             case("text"):
    //                 if(isset($message["text"])){
    //                     $message["text"] = str_replace("{name}", $name, $message["text"]);
    //                 }
    //                 break;
    //             case("template"):
    //                 if(isset($message["template"]["action"],$message["template"]["action"]["data"])){

    //                 }
    //                 if(isset($message["template"]["defaultAction"],$message["template"]["defaultAction"]["data"])){

    //                 }
    //                 if(isset($message["template"]["actions"])){

    //                 }

    //         }
    //         return $message;
    //     });
    //     return $messages;
    // }
}
