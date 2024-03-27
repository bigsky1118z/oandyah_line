<?php

namespace App\Models\Line;

use App\Models\Line\Message\LineMessageAudio;
use App\Models\Line\Message\LineMessageFlex;
use App\Models\Line\Message\LineMessageImage;
use App\Models\Line\Message\LineMessageImagemap;
use App\Models\Line\Message\LineMessageLocation;
use App\Models\Line\Message\LineMessageSticker;
use App\Models\Line\Message\LineMessageTemplate;
use App\Models\Line\Message\LineMessageText;
use App\Models\Line\Message\LineMessageVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\map;
use function PHPSTORM_META\type;

class Line extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "user_id",
        "name",
        "channel_access_token",
        "line_user_id",
        "basic_id",
        "display_name",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",
    );

    public function groups($line_group_id = null)
    {
        if($line_group_id){
            return $this->hasOne(LineGroup::class)->whereLinegroupId($line_group_id);
        } else {
            return $this->hasMany(LineGroup::class);
        }
    }
    public function friends($line_friend_id = null)
    {
        if($line_friend_id){
            return $this->hasOne(LineFriend::class)->whereLineFriendId($line_friend_id);
        } else {
            return $this->hasMany(LineFriend::class);
        }
    }
    public function webhooks($type = null)
    {
        if($type){
            switch($type){
                case("follow"):
                case("unfollow"):
                    return $this->hasMany(LineWebhook::class)->whereIn("type",array("follow","unfollow"))->get();
                    break;
                default:
                    return $this->hasMany(LineWebhook::class)->whereType($type)->get();
            }
        } else {
            return $this->hasMany(LineWebhook::class);
        }
    }
    public function messages($type = null)
    {
        if($type){
            return $this->hasMany(LineMessage::class)->whereType($type)->get();
        } else {
            return $this->hasMany(LineMessage::class);
        }
    }
    public function message($message_id)
    {
        return $this->hasOne(LineMessage::class)->whereId($message_id);
    }

    public function message_objects($type = null)
    {
        return match($type){
            "text"      =>  $this->hasMany(LineMessageText::class)->orderByDesc("updated_at"),
            "sticker"   =>  $this->hasMany(LineMessageSticker::class)->orderByDesc("updated_at"),
            "image"     =>  $this->hasMany(LineMessageImage::class)->orderByDesc("updated_at"),
            "video"     =>  $this->hasMany(LineMessageVideo::class)->orderByDesc("updated_at"),
            "audio"     =>  $this->hasMany(LineMessageAudio::class)->orderByDesc("updated_at"),
            "location"  =>  $this->hasMany(LineMessageLocation::class)->orderByDesc("updated_at"),
            "imagemap"  =>  $this->hasMany(LineMessageImagemap::class)->orderByDesc("updated_at"),
            "template"  =>  $this->hasMany(LineMessageTemplate::class)->orderByDesc("updated_at"),
            "flex"      =>  $this->hasMany(LineMessageFlex::class)->orderByDesc("updated_at"),
            default     =>  array(),
        };
    }




    public function get_bot_channel_webhook_endpoint()
    {
        $endpoint   =   "https://oandyah.com/line/" . $this->name. "/webhook";
        $headers    =   array(
            "Authorization" => "Bearer ". $this->channel_access_token,
            "Content-Type"  =>  "application/json",
        );
        $data       =   array(
            "endpoint"  =>  $endpoint,
        );
        $url        =   "https://api.line.me/v2/bot/channel/webhook/test";

        $response   =   Http::withHeaders($headers)->post($url, $data);
        $response["success"] ? null : $this->put_bot_channel_webhook_endpoint();
        return $endpoint;
    }

    public function put_bot_channel_webhook_endpoint()
    {
        $endpoint   =   "https://oandyah.com/line/" . $this->name. "/webhook";
        $headers    =   array(
            "Authorization" => "Bearer ". $this->channel_access_token,
            "Content-Type"  =>  "application/json",
        );
        $data       =   array(
            "endpoint"  =>  $endpoint,
        );
        $url        =   "https://api.line.me/v2/bot/channel/webhook/endpoint";
        Http::withHeaders($headers)->put($url, $data);
    }

    /** line bot の設定を取得する */

    public function get_bot_info()
    {
        $headers    = array(
            'Authorization' => 'Bearer '. $this->channel_access_token,
        );
        $url        =   "https://api.line.me/v2/bot/info";
        $response   =   Http::withHeaders($headers)->get($url);
        if($response->successful()){
            isset($response['userId'])          ?   $this->line_user_id         =   $response['userId']         :   null;
            isset($response['displayName'])     ?   $this->display_name         =   $response['displayName']    :   null;
            isset($response['basicId'])         ?   $this->basic_id             =   $response['basicId']        :   null;
            isset($response['premiumId'])       ?   $this->premium_id           =   $response['premiumId']      :   null;
            isset($response['pictureUrl'])      ?   $this->picture_url          =   $response['pictureUrl']     :   null;
            isset($response['chatMode'])        ?   $this->chat_mode            =   $response['chatMode']       :   null;
            isset($response['markAsReadMode'])  ?   $this->mark_as_read_mode    =   $response['markAsReadMode'] :   null;
            $this->save();
        }
    }

    /** line bot のステータスを取得する */
    public function get_bot_insight_followers($date = null)
    {
        $headers    = array(
            'Authorization' => 'Bearer '. $this->channel_access_token,
        );
        $url    =   "https://api.line.me/v2/bot/insight/followers?date=";
        if($date){
            $url    .=  "";

        } else {
            $url    .=  date("Ymd");
        }
        $response = Http::withHeaders($headers)->get($url);
        return $response->json();   // "status", "followers", "targetedReaches", "blocks"
    }

    public function get_bot_insight_demographic($key)
    {
        $headers    =   array(
            'Authorization' => 'Bearer '. $this->channel_access_token,
        );
        $url        =   "https://api.line.me/v2/bot/insight/demographic";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response["available"] && isset($response[$key]) ? $response[$key] : null;
    }

    public function get_bot_message_quota()
    {
        $headers    =   array(
            'Authorization' => 'Bearer '. $this->channel_access_token,
        );
        $url        =   "https://api.line.me/v2/bot/message/quota";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response->json();   // "type", "value"
    }

    public function get_bot_message_quota_consumption()
    {
        $headers    =   array(
            'Authorization' => 'Bearer '. $this->channel_access_token,
        );
        $url        =   "https://api.line.me/v2/bot/message/quota/consumption";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response->json();   // "type", "value"
    }

    public function get_bot_message_quota_limit()
    {
        $limit  =   0;
        if(isset($this->get_bot_message_quota()["value"],$this->get_bot_message_quota_consumption()["totalUsage"])){
            $quota          =   $this->get_bot_message_quota()["value"];
            $consumption    =   $this->get_bot_message_quota_consumption()["totalUsage"];
            $limit          =   (int) $quota - (int) $consumption;
        }
        return $limit;
    }



    public function post_bot_message_reply($messages, $reply_token)
    {
        $headers    =   array(
            "Authorization" => "Bearer ". $this->channel_access_token,
            "Content-Type"  =>  "application/json",
        );
        $data       =   array(
            "replyToken"    =>  $reply_token,
            "messages"      =>  $messages,
        );
        $url        =   "https://api.line.me/v2/bot/message/reply";

        $response   =   Http::withHeaders($headers)->post($url, $data);
        return $response;
    }
}
