<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiReply extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "name",
        "type",
        "active",
        "condition",
        "messages",
        "line_api_message_1_id",
        "line_api_message_2_id",
        "line_api_message_3_id",
        "line_api_message_4_id",
        "line_api_message_5_id",
        "notification_disabled",
        "valid_at",
        "expired_at",
    );


    protected $casts = [
        "messages"                  =>  "json",
        "active"                    =>  "boolean",
        "notification_disabled"     =>  "boolean",
    ];

    public static $postback_action_names    =   array(
        "event"             =>  "イベント",
        "fortune_telling"   =>  "占い",
        "order"             =>  "オーダー",
        "questionnaire"     =>  "アンケート",
        "quiz"              =>  "クイズ",
        "others"            =>  "その他",
    );

    public function line_api_message_1()
    {
        return $this->belongsTo(LineApiMessage::class, "line_api_message_1_id")->whereChannelName($this->channel_name);
    }
    public function line_api_message_2()
    {
        return $this->belongsTo(LineApiMessage::class, "line_api_message_2_id")->whereChannelName($this->channel_name);
    }
    public function line_api_message_3()
    {
        return $this->belongsTo(LineApiMessage::class, "line_api_message_3_id")->whereChannelName($this->channel_name);
    }
    public function line_api_message_4()
    {
        return $this->belongsTo(LineApiMessage::class, "line_api_message_4_id")->whereChannelName($this->channel_name);
    }
    public function line_api_message_5()
    {
        return $this->belongsTo(LineApiMessage::class, "line_api_message_5_id")->whereChannelName($this->channel_name);
    }
    public function line_api_messages()
    {
        $line_api_messages  =   array();
        $this->line_api_message_1   ?   $line_api_messages[]    =   $this->line_api_message_1   :   null;
        $this->line_api_message_2   ?   $line_api_messages[]    =   $this->line_api_message_2   :   null;
        $this->line_api_message_3   ?   $line_api_messages[]    =   $this->line_api_message_3   :   null;
        $this->line_api_message_4   ?   $line_api_messages[]    =   $this->line_api_message_4   :   null;
        $this->line_api_message_5   ?   $line_api_messages[]    =   $this->line_api_message_5   :   null;
        return $line_api_messages;
    }

    public function get_validity_period()
    {
        $validity_period    =   "設定なし";
        isset($this->valid_at) && isset($this->expired_at) ? $validity_period = "$this->valid_at ～ $this->expired_at" : null;
        isset($this->valid_at) && !isset($this->expired_at) ? $validity_period = "$this->valid_at ～" : null;
        !isset($this->valid_at) && isset($this->expired_at) ? $validity_period = "～ $this->expired_at" : null;
        return $validity_period;
    }


    // LINE API MESSAGE を取得する
    public function get_line_api_messages()
    {
        $line_api_messages  =   array();
        foreach($this->messages as $line_api_message_id){
            $line_api_message   =   LineApiMessage::find($line_api_message_id);
            $line_api_message ? $line_api_messages[] = $line_api_message : null;
        }
        return $line_api_messages;
    }
    // LINE API MESSAGE からメッセージオブジェクトを取得する
    public function get_message_objects()
    {
        $replaced_messages  =   array();
        foreach($this->get_line_api_messages() as $line_api_message){
            $message    =   $line_api_message->get_message_object();
            if(isset($message["text"])){
                $message["text"] = $this->replace_tag_to_name($message["text"]);
            }
            if(isset($message["altText"])){
                $message["altText"] = $this->replace_tag_to_name($message["altText"]);
            }
            if(isset($message["template"]["title"])){
                $message["template"]["title"] = $this->replace_tag_to_name($message["template"]["title"]);
            }
            if(isset($message["template"]["text"])){
                $message["template"]["text"] = $this->replace_tag_to_name($message["template"]["text"]);
            }
            if(isset($message["template"]["defaultAction"])){
                $replace_action =   $this->get_replace_action($message["template"]["defaultAction"]);
                foreach($replace_action as $key => $value){
                    $message["template"]["defaultAction"][$key] =   $value;
                }
            }
            if(isset($message["template"]["actions"])){
                foreach($message["template"]["actions"] as $action_index => $action){
                    $replace_action =   $this->get_replace_action($action);
                    foreach($replace_action as $key => $value){
                        $message["template"]["actions"][$action_index][$key] =   $value;
                    }
                }
            }
            if(isset($message["template"]["columns"])){
                foreach($message["template"]["columns"] as $column_index => $column){
                    if(isset($column["title"])){
                        $message["template"]["columns"][$column_index]["title"] = $this->replace_tag_to_name($column["title"]);
                    }
                    if(isset($column["text"])){
                        $message["template"]["columns"][$column_index]["text"] = $this->replace_tag_to_name($column["text"]);
                    }
                    if(isset($column["defaultAction"])){
                        $replace_action =   $this->get_replace_action($column["defaultAction"]);
                        foreach($replace_action as $key => $value){
                            $message["template"]["columns"][$column_index]["defaultAction"][$key] =   $value;
                        }    
                    }
                    if(isset($column["actions"])){
                        foreach($column["actions"] as $column_action_index => $column_action){
                            $replace_action =   $this->get_replace_action($column_action);
                            foreach($replace_action as $key => $value){
                                $message["template"]["columns"][$column_index]["actions"][$column_action_index][$key] =   $value;
                            }
                        }
                    }
                    if(isset($column["action"])){
                        $replace_action =   $this->get_replace_action($column["action"]);
                        foreach($replace_action as $key => $value){
                            $message["template"]["columns"][$column_index]["action"][$key] =   $value;
                        }
                    }
                }
            }
            $replaced_messages[]    =   $message;
        }
        return $replaced_messages;
    }
        public function get_replace_action($action)
        {
            $replace_action =   array();
            foreach($action as $key => $value){
                switch($key){
                    case("label"):
                        $new_label  =   $this->replace_tag_to_name($value);
                        if(strlen($new_label)<=20){
                            $replace_action[$key]   =   $this->replace_tag_to_name($value);
                        }
                        if(strlen($new_label)>20){
                            $replace_action[$key]   =   $this->replace_tag_to_name($value, false);
                        }
                        break;
                    case("data"):
                        $replace_action[$key]   =   $this->replace_tag_to_user_id($value);
                        break;
                    default:
                        $replace_action[$key]   =   $this->replace_tag_to_name($value);
                }
            }
            return $replace_action;
        }
        public function replace_tag_to_name($string, $validate = true)
        {
            if($this->endpoint_type == "push" && $validate){
                return str_replace(["{name}", "{you}", "{user}"],  $this->user->nickname(), $string);
            } else {
                return str_replace(["{name}", "{you}", "{user}"],  "あなた", $string);
            }
        }
        public function replace_tag_to_user_id($string)
        {
            if($this->endpoint_type == "push"){
                return str_replace("user_id=user_id",  "user_id=$this->to", $string);
            } else {
                return str_replace("user_id=user_id",  "user_id=all", $string);
            }
        }    
}
