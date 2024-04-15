<?php

namespace App\Models\App;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppWebhook extends Model
{
    use HasFactory;

    protected $fillable =   [
        "app_id",

        "ip_address",
        "request_host",
        "request_path",
        "request_method",
        "request_body",
        "x_line_signature",
        "response_status",
        "destination",
        "query_string",
        "event",
    ];

    protected $casts    =   [
        "request_body"      =>  "json",
        "event"             =>  "json",
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function get_friend()
    {
        $friend_id  =   $this->event["source"]["userId"] ?? null;
        $friend     =   $friend_id
                    ?   AppFriend::updateOrCreate(array(
                            "app_id"    =>  $this->app->id,
                            "friend_id" =>  $friend_id,
                        ))
                    :   new AppFriend();
        return $friend;
    }

    public function get_type()
    {
        return $this->event["type"] ?? null;
    }

    public function get_reply_token()
    {
        return $this->event["replyToken"] ?? null;
    }

    public function get_event($key)
    {
        return $this->event[$key] ?? null;
    }

    /** POST 時の functions */
    public function auto()
    {
        $app    =   $this->app;
        $type   =   $this->event["type"] ?? null;
        $friend =   $this->get_friend();
        if(($type == "follow" || $type == "unfollow") && $friend->id){
            $friend->status =   $type;
            $friend->save();
        }
        $autos      =   AppAuto::whereAppId($app->id)->whereType($type)->get();
        $message    =   $app->messages()->first();
        if($message){
            AppSend::Create(array(
                "app_id"            =>  $app->id,
                "friend_id"         =>  $friend->friend_id,
                "type"              =>  "reply",
                "reply_token"       =>  $this->get_reply_token(),
                "app_message_id"    =>  $message->id,
            ))->post_bot_message();
        }
        return;
        
        switch($type){
            case("follow"):
            case("unfollow"):
                if($friend->id){
                    if($type == "follow"){
                        $message    =   $autos->first()->message->app->id;
                        // $message    =   AppMessage::first();
                        AppSend::Create(array(
                            "app_id"            =>  $app->id,
                            "friend_id"         =>  $friend->friend_id,
                            "type"              =>  "reply",
                            "reply_token"       =>  $this->get_reply_token(),
                            "app_message_id"    =>  $message->id,
                        ))->post_bot_message();
                    }
                }
                break;
            case("message"):
                $auto       =   $autos()->first();
                $message    =   $auto->message ?? null;
                if($message){
                    AppSend::Create(array(
                        "app_id"            =>  $app->id,
                        "friend_id"         =>  $friend->friend_id,
                        "type"              =>  "reply",
                        "reply_token"       =>  $this->get_reply_token(),
                        "app_message_id"    =>  $message->id,
                    ))->post_bot_message();
                }
                break;
        }
    }

}
