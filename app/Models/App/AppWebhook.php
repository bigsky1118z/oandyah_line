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

        "friend_id",
        "group_id",
        "room_id",

        "type",
        "mode",
        "webhook_event_id",
        "reply_token",
        "is_redelivery",
        
        "event",
    ];

    protected $casts    =   [
        "request_body"  =>  "json",
        "event"         =>  "json",
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function reply()
    {
        $app            =   $this->app;
        $reply_token    =   $this->reply_token;
        switch($this->type){
            case("message"):
                AppMessage::post_bot_message_reply($app, $reply_token);
                break;
        }
    }

}
