<?php

namespace App\Models\Line;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineWebhook extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_id",

        "ip_address",
        "request_host",
        "request_path",
        "request_method",
        "x_line_signature",
        "response_status",
        "destination",
        "query_string",

        "line_user_id",
        "line_group_id",
        "line_room_id",

        "type",
        "mode",
        "webhook_event_id",
        "reply_token",
        "is_redelivery",
        
        "event",
    );

    protected $casts    =   array(
        "event" =>  "json",
    );

    public function line()
    {
        return $this->belongsTo(Line::class,"line_id");
    }


    public function friend()
    {
        return $this->belongsTo(LineFriend::class,"line_user_id","line_user_id")->whereLineId($this->line_id);
    }


    public function message()
    {
        return $this->hasOne(LineWebhookMessage::class);
    }

    public function postback()
    {
        return $this->hasOne(LineWebhookPostback::class);
    }


}
