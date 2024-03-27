<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApi extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination',
        "query_string",
        'type',
        'mode',
        'webhook_event_id',
        'reply_token',
        'line_user_id',
        'line_group_id',
        'is_redelivery',
        'event',
    ];

    protected $casts = [
        'event'  => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(LineApiUser::class,"line_user_id","line_user_id");
    }
    public static $admin_id     =   "Ubaabca160ab17a89e7ede64cc084cbb5";
    public static $access_token =   "DevGS+xmzvpISz1LGy8LxAnjxCY15MFSXRljWAXFXvgJDkWVshk+96bkn4JIPaaB0s+2xKTuJbYlch10BctkIjTHIwEPcCirPr5S1JFgfQgf9MaMQb2YQowhEBGT5eBkVHIDCAeddeimB03lpslywAdB04t89/1O/w1cDnyilFU=";

    public static function profile_url($line_user_id)
    {
        $url    =   'https://api.line.me/v2/bot/profile/'.$line_user_id;
        return $url;
    }

    public static $message_url  =   array(
        "reply"         =>  "https://api.line.me/v2/bot/message/reply",
        "push"          =>  "https://api.line.me/v2/bot/message/push",
        "multicast"     =>  "https://api.line.me/v2/bot/message/multicast",
        "narrowcast"    =>  "https://api.line.me/v2/bot/message/narrowcast",
        "broadcast"     =>  "https://api.line.me/v2/bot/message/broadcast",
    );

    public static $validate_url =   array(
        "reply"         =>  "https://api.line.me/v2/bot/message/validate/reply",
        "push"          =>  "https://api.line.me/v2/bot/message/validate/push",
        "multicast"     =>  "https://api.line.me/v2/bot/message/validate/multicast",
        "narrowcast"    =>  "https://api.line.me/v2/bot/message/validate/narrowcast",
        "broadcast"     =>  "https://api.line.me/v2/bot/message/validate/broadcast",
    );
 
    public static $delivery_url =   array(
        "reply"         =>  "https://api.line.me/v2/bot/message/delivery/reply",
        "push"          =>  "https://api.line.me/v2/bot/message/delivery/push",
        "multicast"     =>  "https://api.line.me/v2/bot/message/delivery/multicast",
        "broadcast"     =>  "https://api.line.me/v2/bot/message/delivery/broadcast",
    );

// GET  /v2/bot/message/progress/narrowcast
// GET  /v2/bot/message/quota
// GET  /v2/bot/message/quota/consumption
// GET  /v2/bot/message/aggregation/info
// GET  /v2/bot/message/aggregation/list


}
