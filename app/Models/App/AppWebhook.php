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

        "source",
        "friend_id",
        "group_id",
        "room_id",

        "type",
        "mode",
        "webhook_event_id",
        "reply_token",

        "delivery_context",
        
        "event",
    ];

    protected $casts    =   [
        "request_body"      =>  "json",
        "source"            =>  "json",
        "delivery_context"  =>  "json",

        "event"             =>  "json",
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function action()
    {
        $app            =   $this->app;
        $type           =   $this->type;

        switch($this->type){
            case("follow"):
            case("unfollow"):
                $friend =   AppFriend::createOrUpdate(array(
                    "app_id"    =>  $app->id,
                    "friend_id" =>  $this->friend_id,
                ),array(
                    "status"    =>  $this->type,
                ));
            // case("message"):
            //     AppMessage::post_bot_message_reply($app, $reply_token);
            //     break;
        }
    }

}
