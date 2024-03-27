<?php

namespace App\Models\Line;

use App\Models\Line\Message\LineMessageAudio;
use App\Models\Line\Message\LineMessageFlex;
use App\Models\Line\Message\LineMessageImage;
use App\Models\Line\Message\LineMessageImagemap;
use App\Models\Line\Message\LineMessageLocation;
use App\Models\Line\Message\LineMessageObject;
use App\Models\Line\Message\LineMessageSticker;
use App\Models\Line\Message\LineMessageTemplate;
use App\Models\Line\Message\LineMessageText;
use App\Models\Line\Message\LineMessageVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class LineMessage extends Model
{
    use HasFactory;
    
    protected $fillable =   array(
        "line_id",
        "status",

        "type",
        "notification_disabled",
        "custom_aggregation_units",

        "reply_token",
        "line_user_id",
        "line_user_ids",
        "recipient",
        "filter",
        "limit",

        "response_status",
        "error_message",
        "sent_messages",

        "send_date",
    );

    protected $casts    =   array(
        "notification_disabled" =>  "boolean",
        "line_user_ids"         =>  "json",
        "recipient"             =>  "json",
        "filter"                =>  "json",
        "limit"                 =>  "json",
        "error_message"         =>  "json",
        "sent_messages"         =>  "json",
    );

    public static $types    =   array(
        "reply"         =>  "返答",
        "push"          =>  "個人",
        "narrowcast"    =>  "属性",
        "broadcast"     =>  "全員",
    );

    public function line()
    {
        return $this->belongsTo(Line::class);
    }
    public function friend()
    {
        return $this->belongsTo(LineFriend::class,"line_user_id","line_user_id")->whereLineId($this->line_id);
    }

    public function message_objects($index = null)
    {
        if(1 <= $index && $index <= 5 ) {
            return $this->hasOne(LineMessageObject::class)->whereIndex($index);
        } else {
            return $this->hasMany(LineMessageObject::class)->orderBy("index");
        }
    }

    public function sending()
    {
        if($this->status == "sent"){
            return ;
        } else {
            $headers    =   array(
                "Authorization" => "Bearer ". $this->line->channel_access_token,
                "Content-Type"  =>  "application/json",
            );
            $data   =   array(
                "notificationDisabled"      =>  $this->notification_disabled,
                "messages"                  =>  $this->get_messages(),
                "customAggregationUnits"    =>  array($this->custom_aggregation_units),
                "to"                        =>  $this->line_user_id,
                "replyToken"                =>  $this->reply_token,
                "recipient"                 =>  $this->recipient,
                "filter"                    =>  $this->filter,
                "limit"                     =>  $this->limit,
            );
            $url        =   "https://api.line.me/v2/bot/message/$this->type";
            $response   =   null;
            switch($this->type){
                case("push"):
                    $sent_messages  =   array();
                    $error_message  =   array();
                    foreach($this->get_line_user_ids() as $line_user_id){
                        $data["to"]             =   $line_user_id;
                        $data["messages"]       =   $this->get_messages($line_user_id);
                        $response               =   Http::withHeaders($headers)->post("https://api.line.me/v2/bot/message/validate/push", $data);
                        if(!$response->successful()){
                            $this->response_status          =   $response->status();
                            $error_message[$line_user_id]   =   array(
                                "message"   =>  $response["message"]    ??  null,
                                "details"   =>  $response["details"]    ??  null,
                            );
                        }
                    }
                    if(count($error_message) == 0){
                        foreach($this->get_line_user_ids() as $line_user_id){
                            $data["to"]             =   $line_user_id;
                            $data["messages"]       =   $this->get_messages($line_user_id);
                            $response               =   Http::withHeaders($headers)->post($url, $data);
                            if($response->successful()){
                                $this->response_status          =   $response->status();
                                $this->send_date                =   date("Y-m-d H:i:s");
                                $this->status                   =   "sent";
                                $sent_messages[$line_user_id]   =   $response["sentMessages"]   ?? null;
                            } else {
                                $error_message[$line_user_id]   =   array(
                                    "message"   =>  $response["message"]    ??  null,
                                    "details"   =>  $response["details"]    ??  null,
                                );
                                unset($this->line_user_ids[array_search($line_user_id, $this->line_user_ids)]);
                            }
                            $this->sent_messages    = count($sent_messages) ? $sent_messages    : null;
                        }
                        if(count($error_message)){
                            LineMessage::Create(array(
                                "line_id"                   =>  $this->line->id,
                                "status"                    =>  "error",
                                "type"                      =>  "push",
                                "notification_disabled"     =>  $this->notification_disabled,     
                                "custom_aggregation_units"  =>  $this->custom_aggregation_units,  
                                "line_user_id"              =>  array_keys($error_message)[0],
                                "line_user_ids"             =>  array_keys($error_message),
                                "error_message"             =>  $this->error_message,
                            ));
                        }
                    } else {
                        $this->error_message    =   count($error_message)   ? $error_message    : null;
                    }
                    break;
                case("reply"):
                case("narrowcast"):
                case("broadcast"):
                    $response               =   Http::withHeaders($headers)->post($url, $data);
                    $this->response_status  =   $response->status();
                    if($response->successful()){
                        $this->send_date            =   date("Y-m-d H:i:s");
                        $this->status               =   "sent";
                        $sent_messages[$this->type] =   isset($response["sentMessages"])    ? $response["sentMessages"] : null;
                    } else {
                        $this->status               =   "error";
                        $error_message[$this->type] =   array(
                            "message"   =>  isset($response["message"]) ? $response["message"]  : null,
                            "details"   =>  isset($response["details"]) ? $response["details"]  : null,
                        );
                    }
                    break;
            }
            $this->save();
            return $response;

        }
    }

    public function set_message_object_by_id($index, $type, $id)
    {
        if($this->status == "sent"){
            return null;
        }
        if(1 <= $index && $index <= 5){
            $value  =   match($type){
                "text"      =>  LineMessageText::whereLineId($this->line_id)->whereId($id)->first(),
                "sticker"   =>  LineMessageSticker::whereLineId($this->line_id)->whereId($id)->first(),
                "image"     =>  LineMessageImage::whereLineId($this->line_id)->whereId($id)->first(),
                "video"     =>  LineMessageVideo::whereLineId($this->line_id)->whereId($id)->first(),
                "audio"     =>  LineMessageAudio::whereLineId($this->line_id)->whereId($id)->first(),
                "location"  =>  LineMessageLocation::whereLineId($this->line_id)->whereId($id)->first(),
                "imagemap"  =>  LineMessageImagemap::whereLineId($this->line_id)->whereId($id)->first(),
                "template"  =>  LineMessageTemplate::whereLineId($this->line_id)->whereId($id)->first(),
                "flex"      =>  LineMessageFlex::whereLineId($this->line_id)->whereId($id)->first(),
                default     =>  null,
            };
            if($value){
                $message_object =   LineMessageObject::updateOrCreate(array(
                    "line_message_id"       =>  $this->id,
                    "index"                 =>  $index,
                ),array(
                    "type"                  =>  $type,
                    "line_message_type_id"  =>  $value->id,
                ));
                return $message_object;
            } else {
                LineMessageObject::whereLineMessageId($this->id)->whereIndex($index)->delete();
            }
        }
        return null;
    }
    public function set_message_object_by_name($index, $type, $name)
    {
        if($this->status == "sent"){
            return null;
        }
        if(1 <= $index && $index <= 5){
            $value  =   match($type){
                "text"      =>  LineMessageText::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "sticker"   =>  LineMessageSticker::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "image"     =>  LineMessageImage::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "video"     =>  LineMessageVideo::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "audio"     =>  LineMessageAudio::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "location"  =>  LineMessageLocation::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "imagemap"  =>  LineMessageImagemap::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "template"  =>  LineMessageTemplate::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                "flex"      =>  LineMessageFlex::whereLineId($this->line_id)->whereName($name)->latest()->first(),
                default     =>  null,
            };
            if($value){
                $message_object =   LineMessageObject::updateOrCreate(array(
                    "line_message_id"       =>  $this->id,
                    "index"                 =>  $index,
                ),array(
                    "type"                  =>  $type,
                    "line_message_type_id"  =>  $value->id,
                ));
                return $message_object;
            } else {
                LineMessageObject::whereLineMessageId($this->id)->whereIndex($index)->delete();
            }
        }
        return null;
    }

    public function get_message_objects($index = null)
    {
        if($index) {
            return $this->message_objects($index);
        } else {
            $result =   array();
            foreach($this->message_objects as $message_object){
                $result[$message_object->index] =   array(
                    "type"  =>  $message_object->type,
                    "id"    =>  $message_object->line_message_type_id,
                    "name"  =>  $message_object->get_value("name"),
                );
            }
            return $result;
        }
    }
    public function get_messages($line_user_id = null)
    {
        $friend     =   LineFriend::whereLineId($this->line_id)->whereLineUserId($line_user_id)->first();
        $messages   =   array();
        
        foreach($this->message_objects as $message_object){
            $messages[] =   $message_object->get_object($friend);
        }
        $messages   =   array_filter($messages,fn($message)=>$message);
        $messages   =   array_slice($messages, 0, 5);
        return $messages;
    }
    public function get_line_user_ids()
    {
        $line_user_ids  =   array();
        if($this->line_user_id){
            $line_user_ids[]    =   $this->line_user_id;
        }
        if($this->line_user_ids && count($this->line_user_ids)){
            foreach($this->line_user_ids as $line_user_id){
                $line_user_ids[]    =   $line_user_id;
            }
        }
        return array_unique($line_user_ids);
    }


}
