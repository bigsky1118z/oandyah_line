<?php

namespace App\Models\App;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppWebhook extends Model
{
    use HasFactory;

    protected $fillable =   [
        "id",
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
        $app        =   $this->app;
        $friend_id  =   $this->event["source"]["userId"] ?? null;
        $friend     =   $app && $friend_id
                    ?   AppFriend::updateOrCreate(array(
                            "app_id"    =>  $app->id,
                            "friend_id" =>  $friend_id,
                        ))
                    :   new AppFriend();
        return $friend;
    }
    

    /** event内の値を取得する */
        public function get_reply_token()
        {
            return $this->event["replyToken"] ?? null;
        }
        static $event_types    =   array(
            "follow"    =>  "友だち追加",
            "unfollow"  =>  "ブロック",
            "message"   =>  "メッセージ",
        );
        public function get_event_type($mode = null)
        {
            if($mode == "title"){
                return self::$event_types[$this->event["type"]] ?? $this->event["type"] ?? null;
            }
            return $this->event["type"] ?? null;
        }
        public function get_event_message_text()
        {
            return $this->event["message"]["text"] ?? null;
        }

    public function get_event($key)
    {
        return $this->event[$key] ?? null;
    }

    /** POST 時の functions */
        public function reaction()
        {
            $app        =   $this->app;
            $type       =   $this->event["type"] ?? null;
            $friend     =   $this->get_friend();
            switch($type){
                case("follow")  :
                    $reply  =   AppReplyCondition::find_reply_follow($app->id);
                    break;
                case("message") :
                    $message_objects    =   array(
                        array(
                            "type"  =>  "text",
                            "text"  =>  "自動返信",
                        ),
                        array(
                            "type"  =>  "text",
                            "text"  =>  $this->get_event_message_text() ?? "取得失敗",
                        ),                        
                    );
                    $message    =   AppMessage::Create(array(
                        "app_id"        =>  $app->id,
                        "name"          =>  "[自動返信]",
                        "type"          =>  "reply",
                        "datetime"      =>  null,
                        "reply_token"   =>  $this->get_reply_token(),
                        "messages"      =>  $message_objects,
                    ));
                    $message->send_message();            
                    break;
                case("postback") :
                    $data   =   $this->event["postback"]["data"] ?? null;
                    $reply  =   AppReplyCondition::find_reply_postback($app->id, $data);
                    break;
            }
            // if(!$reply->messages){
            //     $default    =   $app->reply_condition_defaults->where("type",$type)->first();
            //     $reply      =   $default ? $default->reply : new AppReply();
            // }
            // if($reply->messages){
            //     // AppSend::Create(array(
            //     //     "app_id"            =>  $app->id,
            //     //     "friend_id"         =>  $friend->friend_id,
            //     //     "type"              =>  "reply",
            //     //     "reply_token"       =>  $this->get_reply_token(),
            //     //     "messages"          =>  $reply->messages,
            //     // ))->post_bot_message();
            // }
            return;
        }

}
