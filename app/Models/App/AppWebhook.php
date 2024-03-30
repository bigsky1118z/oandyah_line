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
        "event" =>  "json",
    ];

    public function app()
    {
        return $this->hasOne(App::class);
    }

    public function reply()
    {
        $app        =   $this->app();
        switch($this->type){
            case("message"):
            default:
                $response   =   AppMessage::post_bot_message_reply($app,$this->reply_token);
                break;
        }
        $this->response_status  =   $response->status();
        $this->mode             =   json_encode($response);
        $this->save();
        return $response;
    }



}
