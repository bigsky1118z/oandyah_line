<?php

namespace App\Models\App;

use App\Library\MessagingApi;
use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppMessage extends Model
{
    use HasFactory;
    protected $fillable =   [
        "id",
        "app_id",
        "name",
        "status",
        
        "type",
        "datetime",

        "response_code",
        "x_line_request_id",

        "x_line_retry_key",

        "push",
        "reply_token",
        "recipient",
        "filter",
        "limit",

        "messages",

        "notification_disabled",
        "custom_aggregation_units",

        "error_messages",
        "error_details",
    ];

    protected $casts    =   [
        "datetime"              =>  "datetime",

        "notification_disabled" =>  "boolean",

        "push"                  =>  "json",
        "recipient"             =>  "json",
        "filter"                =>  "json",
        "limit"                 =>  "json",

        "messages"              =>  "json",
        
        "error_messages"        =>  "json",
        "error_details"         =>  "json",
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
    public function sends()
    {
        return $this->hasMany(AppMessageSend::class);
    }
    public function send()
    {
        return $this->hasOne(AppMessageSend::class);
    }
    
    public function get_friend()
    {
        $friend_id  =   $this->friend_id ?? null;
        $friend     =   $friend_id
                    ?   AppFriend::updateOrCreate(array(
                            "app_id"    =>  $this->app->id,
                            "friend_id" =>  $friend_id,
                        ))
                    :   new AppFriend();
        $friend     =   $friend->latest();
        return $friend;
    }

    public function latest()
    {
        $error_messages =   array();
        $error_details  =   array();
        $validation     =   $this->validate_message();
        if($validation){
            if($validation->successful()){
                if($this->status == "reserved" || $this->status == "sent"){
                } else {
                    $this->status   =   "standby";
                }
            } else {
                $this->status       =   "draft";
                $error_messages[]   =   $validation->json("message");
                $error_details      =   $validation->json("details");
            }
        } else {
            $this->status       =   "draft";
        }
    $this->error_messages   =   $error_messages;
        $this->error_details    =   $error_details;
        $this->save();
        return $this;
    }

    static $statuses    =   array(
        "draft"     =>  "下書き",
        "standby"   =>  "送信可能",
        "reserved"  =>  "送信予約",
        "sent"      =>  "送信済み",
    );
    public function get_status()
    {
        return self::$statuses[$this->status] ?? $this->status;
    }

    static $types   =   array(
        "reply"         =>  "返答",
        "push"          =>  "宛先指定",
        "broadcast"     =>  "一斉送信",
        "narrowcast"    =>  "条件送信",
    );
    public function get_type()
    {
        return self::$types[$this->type] ?? $this->type;
    }

    public function get_friends()
    {
        $app        =   $this->app ?? new App();
        $friends    =   array();
        foreach(($this->push ?? array()) as $friend_id){
            $friend =   AppFriend::where("app_id",$app->id)->where("friend_id",$friend_id)->first();
            $friend ?   $friends[]  =   $friend :   null;
        }
        return $friends;
    }




    static function schedule()
    {        
        self::send_reserved_message();
    }
        static function send_reserved_message()
        {
            $messages   =   self::where("status","reserved")->where("datetime","<=",now())->get();
            return $messages;
            foreach($messages as $message){
                $message->send_message();
            }
        }


    /** MessagingApi */
        public function create_data()
        {
            $data   =   array(
                "messages"              =>  $this->messages,
                "notificationDisabled"  =>  $this->notification_disabled,
            );
            switch($this->type){
                case("push"):
                    if($this->custom_aggregation_units){
                        $data["customAggregationUnits"] =   array($this->custom_aggregation_units);
                    }
                    $data_array =   array();
                    foreach(($this->push ?? array()) as $friend_id){
                        $datum          =   $data;
                        $datum["to"]    =   $friend_id;
                        $data_array[]   =   $datum;
                    }
                    return $data_array;
                    break;
                case("reply"):
                    $data["replyToken"] =   $this->reply_token;
                    $data["to"]         =   $this->push[0] ?? null;
                    break;
            }
            return $data;
        }

        public function validate_message()
        {
            $app                    =   $this->app ?? new App();
            $channel_access_token   =   $app->channel_access_token;
            $data                   =   $this->create_data();
            $response               =   null;
            switch($this->type){
                case("reply"):
                    $response   =   MessagingApi::velidate_message_reply($channel_access_token, $data);
                    break;
                case("push"):
                    $data       =   $data[0] ?? array();
                    $response   =   MessagingApi::velidate_message_push($channel_access_token, $data);
                    break;
            }
            return $response;        
        }

        public function send_message()
        {
            if($this->status == "standby"){
                if($this->datetime && $this->datetime->gt(now())){
                    $this->status   =   "reserved";
                } else {
                    switch($this->type){
                        case("push"):
                            $data_array =   $this->create_data();
                            foreach($data_array as $data){
                                $send   =   AppMessageSend::Create(array(
                                    "app_message_id"    =>  $this->id,
                                    "data"              =>  $data,
                                    "friend_id"         =>  $data["to"] ?? null,
                                ));
                                $send->sending();
                            }
                            break;
                        case("reply"):
                        case("broadcast"):
                        case("narrowcast"):
                            $data   =   $this->create_data();
                            $send   =   AppMessageSend::create(array(
                                "app_message_id"    =>  $this->id,
                                "data"              =>  $data,
                                "friend_id"         =>  $data["to"] ?? null,
                            ));
                            $send->sending();
                            break;
                    }
                    $this->datetime =   now();
                    $this->status   =   "sent";
                }
            }
            $this->save();
            return $this;
        }
    

    /** messagesを適した形式に変換する */
        static function convert_message_objects($messages) {
            $messages   =   $messages ?? array();
            $messages   =   array_filter($messages,fn($message)=>self::validate_message_object($message));
            $messages   =   array_map(fn($message)=>self::convert_template_objects($message),$messages);
            $messages   =   array_values($messages);
            $messages   =   array_slice($messages, 0, 5);
            return $messages;
            return $messages;
        }
            static function validate_message_object($message)
            {
                $validation =   true;
                switch(($message["type"] ?? null)){
                    case("text"):
                        $validation =   $validation ?   !is_null($message["text"] ?? null)                  : $validation;
                        break;
                    case("image"):
                        $validation =   $validation ?   !is_null($message["originalContentUrl"] ?? null)    : $validation;
                        $validation =   $validation ?   !is_null($message["previewImageUrl"]    ?? null)    : $validation;
                        break;
                    case("template"):
                        $validation =   $validation ?   !is_null($message["altText"]            ?? null)    : $validation;
                        $validation =   $validation ?   !is_null($message["template"]["type"]   ?? null)    : $validation;
                        break;    
                    default:
                        $validation =   false;
                        break;
                }
                return $validation;
            }
            static function convert_template_objects($message)
            {
                if(($message["type"]) == "template" && isset($message["template"])){
                    switch(($message["template"]["type"] ?? null)){
                        case("buttons"):
                            if(is_null($message["template"]["thumbnailImageUrl"] ?? null)){
                                unset($message["template"]["thumbnailImageUrl"]);
                                unset($message["template"]["imageAspectRatio"]);
                                unset($message["template"]["imageSize"]);
                                unset($message["template"]["imageBackgroundColor"]);
                            }
                            if(is_null($message["template"]["title"] ?? null)){
                                unset($message["template"]["title"]);
                            }
                            $default_action =   $message["template"]["defaultAction"] ?? array();
                            if(self::validate_action_object($default_action)){
                                $default_action =   self::convert_action_object($default_action);
                                $message["template"]["defaultAction"] =   $default_action;
                            }else{
                                unset($message["template"]["defaultAction"]);
                            }
                            $actions    =   $message["template"]["actions"] ?? array();
                            $actions    =   array_filter($actions,fn($action)=>self::validate_action_object($action));
                            $actions    =   array_map(fn($action)=>self::convert_action_object($action),$actions);
                            $actions    =   array_slice($actions, 0, 4);
                            $message["template"]["actions"] =   $actions;
                            break;
                        case("confirm"):
                            break;
                        case("carousel"):
                            break;
                        case("image_carousel"):
                            break;
                    }
        
                }
                return $message;
            }
                static function validate_action_object($action)
                {
                    $validation =   true;
                    $validation =   $validation ?   !is_null($action["type"] ?? null)   : $validation;
                    $validation =   $validation ?   !is_null($action["label"] ?? null)  : $validation;
                    switch(($action["type"] ?? null)){
                        case("postback"):
                            // $validation =   $validation ?   !is_null($action["text"] ?? null)                  : $validation;
                            break;
                        case("message"):
                            $validation =   $validation ?   !is_null($action["text"] ?? null)   : $validation;
                            break;
                        case("uri"):
                            break;    
                        case("datetimepicker"):
                            break;        
                        case("camera"):
                            break;        
                        case("cameraRoll"):
                            break;        
                        case("location"):
                            break;        
                        case("richmenuswitch"):
                            break;        
                        case("clipboard"):
                            break;        
                        default:
                            $validation =   false;
                            break;
                    }
                    return $validation;
                }
                static function convert_action_object($action)
                {
                    switch(($action["type"] ?? null)){
                        case("postback"):
                            break;
                        case("message"):
                            break;
                        case("uri"):
                            break;    
                        case("datetimepicker"):
                            break;        
                        case("camera"):
                            break;        
                        case("cameraRoll"):
                            break;        
                        case("location"):
                            break;        
                        case("richmenuswitch"):
                            break;        
                        case("clipboard"):
                            break;        
                    }
                    return $action;
                }
}
