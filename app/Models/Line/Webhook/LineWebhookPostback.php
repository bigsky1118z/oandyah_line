<?php

namespace App\Models\Line\Webhook;

use App\Models\Line\LineMessage;
use App\Models\Line\LineWebhook;
use App\Models\Line\Message\LineMessageObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineWebhookPostback extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_webhook_id",
        "status",
        "data",
        "date",
        "new_rich_menu_alias_id",
        "rich_menu_switch_status",
    );

    public static $statuses =   array(
        "un_replied"        =>  "未返信",
        "automatic_reply"   =>  "自動返信",
    );


    public function webhook()
    {
        return $this->belongsTo(LineWebhook::class,"line_webhook_id");
    }

    public function set_values($data)
    {
        $this->data =   isset($data["data"])    ? $data["data"] : null;
        foreach(array("date","time","datetime") as $value){
            isset($data["params"][$value])  ? $this->date   = $data["params"][$value]   : null;
        }
        isset($data["params"]["newRichMenuAliasId"])    ? $this->new_rich_menu_alias_id     = $data["params"]["newRichMenuAliasId"] : null;
        isset($data["params"]["status"])                ? $this->rich_menu_switch_status    = $data["params"]["status"]             : null;
        $this->save();
    }

    public function get_data()
    {
        $result =   array();
        parse_str($this->data,$result);
        return $result;
    }

    public function automatic_reply($reply_token)
    {
        $message_object_1   =   null;
        $message_object_2   =   null;
        $message_object_3   =   null;
        $message_object_4   =   null;
        $message_object_5   =   null;
        $data   =   $this->get_data();
        if(isset($data["action"])){
            switch($data["action"]){
                case("order"):
                    $message_object_1   =   $this->get_message_object("automatic_reply", "ポストバック自動返答");
                    break;
                    $message_object_1   =   $this->get_message_object("automatic_reply", "メッセージ自動返答");
                    $message_object_2   =   $this->get_message_object("automatic_reply", "ポストバック自動返答");
                default:
            }
        }
        
        if($reply_token && ($message_object_1 || $message_object_2 || $message_object_3 || $message_object_4 || $message_object_5)){
            $line       =   $this->webhook->line;
            $message    =   LineMessage::Create(array(
                "line_id"               =>  $line->id,
                "type"                  =>  "reply",
                "notification_disabled" =>  false,
                "reply_token"           =>  $reply_token,
                "line_user_id"          =>  $this->webhook->line_user_id    ? $this->webhook->line_user_id  : null,
                "message_object_1_id"   =>  $message_object_1               ? $message_object_1->id         : null,
                "message_object_2_id"   =>  $message_object_2               ? $message_object_2->id         : null,
                "message_object_3_id"   =>  $message_object_3               ? $message_object_3->id         : null,
                "message_object_4_id"   =>  $message_object_4               ? $message_object_4->id         : null,
                "message_object_5_id"   =>  $message_object_5               ? $message_object_5->id         : null,
            ));
            $response   =   $message->sending();
            if($response->successful()){
                $this->status       =   "automatic_reply";
                $this->save();
            }
        }
    }
    public function get_message_object($status, $name)
    {
        return LineMessageObject::whereLineId($this->webhook->line_id)->whereStatus($status)->whereName($name)->first();
    }


}
