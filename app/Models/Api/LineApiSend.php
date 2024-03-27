<?php

namespace App\Models\Api;

use DateTime;
use Hamcrest\Collection\IsEmptyTraversable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class LineApiSend extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",

        "request_metod",
        "endpoint_type",
        "api_endpoint",

        "status",
        
        "messages",
        "line_api_message_1_id",
        "line_api_message_2_id",
        "line_api_message_3_id",
        "line_api_message_4_id",
        "line_api_message_5_id",
        'notification_disabled',
        
        "to",
        "reply_token",
        "custom_aggregation_units",

        "recipient",
        "filter",
        "limit",
        
        "payload",

        "validate_status",
        "validate_error_message",
        "validate_error_details",

        "response_status",
        "request_id",
        "response_error_message",
        "response_error_details",

        "schedule_at",
        "sent_at",
    );

    protected $casts = [
        'messages'                  =>  'json',
        'notification_disabled'     =>  'boolean',
        'validate_error_details'    =>  'json',
        'response_error_details'    =>  'json',
        'payload'                   =>  'json',
    ];

    // リレーション
    public function channel()
    {
        return $this->hasOne(LineApiChannel::class, "channel_name", "channel_name");
    }
    public function user()
    {
        return $this->hasOne(LineApiUser::class, "line_user_id", "to");
    }

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

    public function get_messages()
    {
        $messages  =   collect($this->line_api_messages())->map(fn($line_api_message) => $line_api_message->get_message_object());
        $target_action  =   array("displayText","fillInText","text","data");
        foreach($messages as $message_index => $message){
            foreach(array("text","altText") as $key1){
                if(isset($message[$key1])){
                    $message[$key1] = $this->replace_tag($message[$key1]);
                }
            }
            if(isset($message["template"])){
                foreach(array("title","text") as $key2){
                    if(isset($message["template"][$key2])){
                        $message["template"][$key2] = $this->replace_tag($message["template"][$key2]);
                    }
                }
                if(isset($message["template"]["defaultAction"])){
                    foreach($target_action as $key3){
                        if(isset($message["template"]["defaultAction"][$key3])){
                            $message["template"]["defaultAction"][$key3] = $this->replace_tag($message["template"]["defaultAction"][$key3]);
                        }
                    }
                }
                if(isset($message["template"]["actions"])){
                    foreach($message["template"]["actions"] as $action_index => $action){
                        foreach($target_action as $key4){
                            if(isset($action[$key4])){
                                $message["template"]["actions"][$action_index][$key4] = $this->replace_tag($action[$key4]);
                            }
                        }
                    }
                }
                if(isset($message["template"]["columns"])){
                    foreach($message["template"]["columns"] as $column_index => $column){
                        foreach(array("title","text") as $key5){
                            if(isset($column[$key5])){
                                $message["template"]["columns"][$column_index][$key5]   =   $this->replace_tag($column[$key5]);
                            }
                        }
                        foreach(array("defaultAction","action") as $key6){
                            if(isset($column[$key6])){
                                foreach($target_action as $key7){
                                    if(isset($column[$key6][$key7])){
                                        $message["template"]["columns"][$key6][$key7] = $this->replace_tag($column[$key6][$key7]);
                                    }
                                }
                            }
                        }
                        if(isset($column["actions"])){
                            foreach($column["actions"] as $column_action_index => $column_action){
                                foreach($target_action as $key8){
                                    if(isset($column_action[$key8])){
                                        $message["template"]["actions"][$column_action_index][$key4] = $this->replace_tag($column_action[$key8]);
                                    }
                                }        
                            }
                        }
                    }
                }
            }
            $messages[$message_index]   =   $message;
        }
        return $messages;
    }

    public function replace_tag($string)
    {
        if($this->endpoint_type == "push"){
            return str_replace(["{name}", "{you}", "{user}"],  $this->user->nickname(), $string);
        } else {
            return str_replace(["{name}", "{you}", "{user}"],  "あなた", $string);
        }
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




    // 送信メソッド
    public function validate()
    {
        $headers    =   array(
            'Content-Type'      =>  'application/json',
            'Authorization'     =>  'Bearer ' . $this->channel->access_token,
        );
        $payload    =   array(
            "messages"              =>  $this->get_messages(),
            "notificationDisabled"  =>  $this->notification_disabled ? true : false,
        );
        if($this->endpoint_type == "push"){
            $payload['to']  =   $this->to;
        }
        if($this->endpoint_type == "reply"){
            $payload['replyToken']  =   $this->reply_token;
        }
        if(isset($this->custom_aggregation_units)){
            $payload['customAggregationUnits']  =   array($this->custom_aggregation_units);
        }

        $validate_urls  =   array(
            "reply"         =>  "https://api.line.me/v2/bot/message/validate/reply",
            "push"          =>  "https://api.line.me/v2/bot/message/validate/push",
            "multicast"     =>  "https://api.line.me/v2/bot/message/validate/multicast",
            "narrowcast"    =>  "https://api.line.me/v2/bot/message/validate/narrowcast",
            "broadcast"     =>  "https://api.line.me/v2/bot/message/validate/broadcast",
        );
        $validate_url   =   $this->endpoint_type ? $validate_urls[$this->endpoint_type] : $validate_urls["push"];

        $response   =  Http::withHeaders($headers)->post($validate_url, $payload);
        $this->validate_status  =   $response->status();
        if($response->successful()){
        } else {
            if(isset($response['message'])){
                $this->validate_error_message    =   $response['message'];
            }
            if(isset($response['details'])){
                $this->validate_error_details    =   $response['details'];
            }
        }
        $this->save();
        return $this;
    }
    public function sending()
    {
        $headers    =   array(
            'Content-Type'      =>  'application/json',
            'Authorization'     =>  'Bearer ' . $this->channel->access_token,
        );
        $payload    =   array(
            "messages"              =>  $this->get_messages(),
            "notificationDisabled"  =>  $this->notification_disabled ? true : false,
        );
        if($this->endpoint_type == "push"){
            $payload['to']  =   $this->to;
        }
        if($this->endpoint_type == "reply"){
            $payload['replyToken']  =   $this->reply_token;
        }
        if(isset($this->custom_aggregation_units)){
            $payload['customAggregationUnits']  =   array($this->custom_aggregation_units);
        }

        $message_urls   =   array(
            "reply"         =>  "https://api.line.me/v2/bot/message/reply",
            "push"          =>  "https://api.line.me/v2/bot/message/push",
            "multicast"     =>  "https://api.line.me/v2/bot/message/multicast",
            "narrowcast"    =>  "https://api.line.me/v2/bot/message/narrowcast",
            "broadcast"     =>  "https://api.line.me/v2/bot/message/broadcast",
        );
        $message_url    =   $this->endpoint_type ? $message_urls[$this->endpoint_type] : null;

        $response   =  Http::withHeaders($headers)->post($message_url, $payload);
        $this->response_status  =   $response->status();
        $this->request_id       =   $response->header("x-line-request-id");
        $this->sent_at          =   (new DateTime())->format('Y-m-d H:i:s');
        if($response->successful()){
            $this->status   =   "送信済み";
        } else {
            $this->status   =   "エラー";
            if(isset($response['message'])){
                $this->response_error_message    =   $response['message'];
            }
            if(isset($response['details'])){
                $this->response_error_details    =   $response['details'];
            }
        }
        $this->save();
        return $this;
    }
}
