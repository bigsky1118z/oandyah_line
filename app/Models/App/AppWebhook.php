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
        "query_string",

        "response_status_code",
        
        "destination",
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
            "postback"  =>  "機能",
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

        public function get_event_postback_data()
        {
            $data                               =   array();
            parse_str(($this->event["postback"]["data"] ?? null), $data);
            $data["friend_id"]                  =   $this->get_friend()->friend_id                              ?? null;
            $data["datetimepicker_date"]        =   $this->event["postback"]["params"]["date"]                  ?? null;
            $data["datetimepicker_time"]        =   $this->event["postback"]["params"]["time"]                  ?? null;
            $data["datetimepicker_datetime"]    =   $this->event["postback"]["params"]["datetime"]              ?? null;
            $data["richmenu_alias_id"]          =   $this->event["postback"]["params"]["newRichMenuAliasId"]    ?? null;
            $data["richmenu_status"]            =   $this->event["postback"]["params"]["status"]                ?? null;
            $data                               =   array_filter($data,fn($value)=>!is_null($value));
            return $data;
        }

        public function get_event($key)
        {
            return $this->event[$key] ?? null;
        }

    /** POST 時の functions */
        public function reaction()
        {
            $app    =   $this->app;
            $type   =   $this->event["type"] ?? null;
            $query  =   null;
            /** queryをtype別で取得する */
            switch($type){
                case("follow"):
                case("message"):
                    $query  =   $this->get_event_message_text();
                    break;
                case("postback"):
                case("datetimepicker"):
                case("richmenuswitch"):
                    $query  =   $this->get_event_postback_data();
                    break;
                case("follow"):
                default:
                    break;
            }
            /** replyを取得する */
            $reply  =   AppReply::get_reply($app->client_id, $type, $query);
            if($reply){
                $friend             =   $this->get_friend();
                $name               =   $reply->name ?? "";
                $message_objects    =   $reply->get() ?? array();
                $message            =   AppMessage::Create(array(
                    "app_id"        =>  $app->id,
                    "name"          =>  "[自動返信]".$name,
                    "type"          =>  "reply",
                    "datetime"      =>  null,
                    "reply_token"   =>  $this->get_reply_token(),
                    "push"          =>  [$friend->friend_id],
                    "messages"      =>  $message_objects,
                ));
                $message    =   $message->latest();
                $message->send_message();
                $this->response_status_code =   $message->send->response_code ?? null;
            }
            $this->save();
            return $this;
        }
}
