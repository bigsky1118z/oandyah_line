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
        $app        =   $this->app;
        $type       =   $this->event["type"] ?? null;
        $friend     =   $this->get_friend();
        $query      =   AppAuto::whereAppId($app->id)->whereEnable(true)->whereType($type);
        switch($type){
            case("message"):
                $text   =   $this->event["message"]["text"] ?? null;
                $query->where(function ($query) use ($text) {
                    $query
                        ->orWhere(fn ($query) => $query->where("condition->match", "exact_match")->where("condition->keyword", "=", "$text"))
                        ->orWhere(fn ($query) => $query->where("condition->match", "forward_match")->where("condition->keyword", "like", "{$text}%"))
                        ->orWhere(fn ($query) => $query->where("condition->match", "backward_match")->where("condition->keyword", "like", "%{$text}"))
                        ->orWhere(fn ($query) => $query->where("condition->match", "partial_match")->where("condition->keyword", "like", "%{$text}%"));
                    });
                break;
        }
        if($query->doesntExist()){
            $query  =   AppAuto::whereAppId($app->id)->whereEnable(true)->whereType($type)->whereHas("default");
        }
        $auto   =   $query->orderBy("priority")->first();
        if($auto){
            AppSend::Create(array(
                "app_id"            =>  $app->id,
                "friend_id"         =>  $friend->friend_id,
                "type"              =>  "reply",
                "reply_token"       =>  $this->get_reply_token(),
                "messages"          =>  $auto->message->messages,
                "app_message_id"    =>  $auto->message->id,
            ))->post_bot_message();
        }
        return;
    }

}
