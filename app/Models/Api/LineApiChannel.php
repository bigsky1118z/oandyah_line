<?php

namespace App\Models\Api;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class LineApiChannel extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "channel_name",
        "access_token",
        "bot_user_id",
        "display_name",
        "basic_id",
        "premium_id",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",
    );

    public function get_chat_url()
    {
        return "https://chat.line.biz/account/" . $this->basic_id;
    }

    public function users ()
    {
        return $this->hasMany(LineApiUser::class, 'channel_name', 'channel_name');
    }

    public function messages()
    {
        return $this->hasMany(LineApiMessage::class, "channel_name", "channel_name");
    }


    public function update_info()
    {
        $headers = array(
            'Authorization' => 'Bearer '. $this->access_token,
        );
        $response = Http::withHeaders($headers)->get("https://api.line.me/v2/bot/info");
        if($response->successful()){
            isset($response['userId'])          ?   $this->bot_user_id          =   $response['userId']         :   null;
            isset($response['displayName'])     ?   $this->display_name         =   $response['displayName']    :   null;
            isset($response['basicId'])         ?   $this->basic_id             =   $response['basicId']        :   null;
            isset($response['premiumId'])       ?   $this->premium_id           =   $response['premiumId']      :   null;
            isset($response['pictureUrl'])      ?   $this->picture_url          =   $response['pictureUrl']     :   null;
            isset($response['chatMode'])        ?   $this->chat_mode            =   $response['chatMode']       :   null;
            isset($response['markAsReadMode'])  ?   $this->mark_as_read_mode    =   $response['markAsReadMode'] :   null;
            $this->save();
        }
    }

    public function create_defaults()
    {
        $follow_message     =   LineApiMessage::Create(array(
            "channel_name"  =>  $this->channel_name,
            "category"      =>  "デフォルト",
            "sub_category"  =>  "フォロー",
            "name"          =>  "友達追加時の自動返信用メッセージ",
            "status"        =>  "デフォルト",
            "display"       =>  "表示",
            "type"          =>  "text",
            "text"          =>  "{name}、フォローありがとうございます。",
        ));

        $message_message    =   LineApiMessage::Create(array(
            "channel_name"  =>  $this->channel_name,
            "category"      =>  "デフォルト",
            "sub_category"  =>  "メッセージ",
            "name"          =>  "メッセージ受信時の自動返信用メッセージ",
            "status"        =>  "デフォルト",
            "display"       =>  "表示",
            "type"          =>  "text",
            "text"          =>  "{you}、メッセージありがとうございます。",
        ));

        $postback_message   =   LineApiMessage::Create(array(
            "channel_name"  =>  $this->channel_name,
            "category"      =>  "デフォルト",
            "sub_category"  =>  "ポストバック",
            "name"          =>  "ポストバック受信時の自動返信用メッセージ",
            "status"        =>  "デフォルト",
            "display"       =>  "表示",
            "type"          =>  "text",
            "text"          =>  "{user}、選択ありがとうございます。",
        ));

        LineApiReply::Create(array(
            "channel_name"          =>  $this->channel_name,
            "name"                  =>  "デフォルト返信",
            "type"                  =>  "follow",
            "active"                =>  true,
            "condition"             =>  "default",
            "line_api_message_1_id" =>  $follow_message->id,
            "notification_disabled" =>  false,    
        ));

        LineApiReply::Create(array(
            "channel_name"          =>  $this->channel_name,
            "name"                  =>  "デフォルト返信",
            "type"                  =>  "message",
            "active"                =>  true,
            "condition"             =>  "default",
            "line_api_message_1_id" =>  $message_message->id,
            "notification_disabled" =>  false,    
        ));

        LineApiReply::Create(array(
            "channel_name"          =>  $this->channel_name,
            "name"                  =>  "デフォルト返信",
            "type"                  =>  "postback",
            "active"                =>  true,
            "condition"             =>  "default",
            "line_api_message_1_id" =>  $postback_message->id,
            "notification_disabled" =>  false,    
        ));
    }

    public function put_endpoint()
    {
        $headers = array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $this->access_token,
        );
        $payload = array(
            'endpoint'    => "https://oandyah.com/api/line/".$this->channel_name,
        );
        $response = Http::withHeaders($headers)->put("https://api.line.me/v2/bot/channel/webhook/endpoint", $payload);
        return $response;
    }

    public function get_endpoint()
    {
        $headers = array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $this->access_token,
        );
        $response = Http::withHeaders($headers)->get("https://api.line.me/v2/bot/channel/webhook/endpoint");
        return $response;
        // Webhook URLが設定されていて、Webhookの利用が有効になっている場合
        // {
        //     "endpoint": "https://example.com/test",
        //     "active": true
        // }
        // // Webhook URLが設定されていて、Webhookの利用が無効になっている場合
        // {
        //     "endpoint": "https://example.com/test",
        //     "active": false
        // }
    }

    public function test_endpoint()
    {
        $headers = array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $this->access_token,
        );
        $payload = array(
            'endpoint'    => "https://oandyah.com/api/line/" . $this->channel_name,
        );
        $response = Http::withHeaders($headers)->post("https://api.line.me/v2/bot/channel/webhook/test", $payload);
        return $response;
    }

    public function get_followers($date = null)
    {
        $headers = array(
            'Authorization'     =>  'Bearer ' . $this->access_token,
        );
        if($date instanceof DateTime){
            $date   =   $date->format("Ymd");
        } else {
            $date   =   date("Ymd");
        }
        $followers  =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/insight/followers?date=".$date);
        if($followers->successful()){
            return $followers->json();
        }else{
            return null;
        }
    }

    public function get_demographic()
    {
        $headers = array(
            'Authorization'     =>  'Bearer ' . $this->access_token,
        );
        $demographic    =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/insight/demographic");
        if($demographic->successful()){
            return $demographic->json();
        }else{
            return null;
        }
    }

}
