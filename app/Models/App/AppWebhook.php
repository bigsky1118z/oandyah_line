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
    public function auto_reply()
    {
        $app    =   $this->app;
        $type   =   $this->event["type"] ?? null;
        switch($type){
            case("follow"):
            case("unfollow"):
                $friend         =   $this->get_friend();
                $friend->status =   $type;
                if($friend->id){
                    $friend->save();
                }
                if($type == "follow"){
                    $send   =   AppSend::Create(array(
                        "app_id"        =>  $app->id,
                        // "frined_id"     =>  $friend->id,
                        // "type"          =>  "reply",
                        // "reply_token"   =>  $this->get_reply_token(),
                    ));
                    $send->post_bot_message();
                }
                break;

            // case("message"):
            //     AppMessage::post_bot_message_reply($app, $reply_token);
            //     break;
        }
    }

}
