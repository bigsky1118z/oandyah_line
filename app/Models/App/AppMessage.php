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
                if($this->status == "reserved" && $this->status == "sent"){
                } else {
                    $this->status   =   "standby";
                }
            } else {
                $this->status       =   "draft";
                $error_messages[]   =   $validation->json("message");
                $error_details      =   $validation->json("details");
            }
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

        }
    

    /** messagesを適した形式に変換する */
        static function convert_message_objects($messages) {
            $messages  =   $messages ?? array();
            $messages  =   array_filter($messages,fn($message)=>self::validate_message_object($message));
            $messages  =   array_values($messages);
            return $messages;
        }
        static function validate_message_object($message)
        {
            $validation =   true;
            $validation =   $validation ? ($message["type"] ?? null) != null    : $validation;
            
            return $validation;
        }



    // static function convert_messages($messages,$friend = null)
    // {
    //     $name       =   $friend->display_name . "さん" ?? "あなた";
    //     $messages   =   $messages->map(function($message) use($name) {
    //         $type   =   $message["type"]    ??  null;
    //         switch($type){
    //             case("text"):
    //                 if(isset($message["text"])){
    //                     $message["text"] = str_replace("{name}", $name, $message["text"]);
    //                 }
    //                 break;
    //             case("template"):
    //                 if(isset($message["template"]["action"],$message["template"]["action"]["data"])){

    //                 }
    //                 if(isset($message["template"]["defaultAction"],$message["template"]["defaultAction"]["data"])){

    //                 }
    //                 if(isset($message["template"]["actions"])){

    //                 }

    //         }
    //         return $message;
    //     });
    //     return $messages;
    // }
    // public function post_bot_message()
    // {
    //     $app        =   $this->app;
    //     $headers    =   array(
    //         "Authorization" =>  "Bearer $app->channel_access_token",
    //         "Content-Type"  =>  "application/json",
    //     );
    //     $friend     =   $this->get_friend();
    //     $messages   =   $this->messages ??  array();
    //     $messages   =   $this->convert_messages($messages, $friend);
    //     $data       =   array(
    //         "replyToken"                =>  $this->reply_token              ??  null,
    //         "to"                        =>  $friend->id                     ??  null,
    //         "recipient"                 =>  $this->recipient                ??  null,
    //         "filter"                    =>  $this->filter                   ??  null,
    //         "limit"                     =>  $this->limit                    ??  null,
    //         "messages"                  =>  $messages                       ??  null,
    //         "customAggregationUnits"    =>  $this->custom_aggregation_units ?   array($this->custom_aggregation_units)  :   null,
    //         "notificationDisabled"      =>  $this->notification_disabled    ??  false,
    //     );
    //     $endpoint               =   "https://api.line.me/v2/bot/message/" . $this->type;
    //     $response               =   Http::withHeaders($headers)->post($endpoint, $data);
    //     $this->response_code    =   $response->status();
    //     if($response->successful()){
    //         $this->sent_messages    =   $response["sentMessages"] ?? null;
    //     } else {
    //         $this->error_message    =   $response["message"];
    //         $this->error_details    =   $response["details"];
    //     }
    //     $this->save();
        
    //     return $response;
    // }

}
