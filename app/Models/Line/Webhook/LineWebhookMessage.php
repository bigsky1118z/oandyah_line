<?php

namespace App\Models\Line\Webhook;

use App\Models\Line\LineMessage;
use App\Models\Line\LineWebhook;
use App\Models\Line\Message\LineMessageObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Spatie\FlareClient\Flare;

use function PHPUnit\Framework\isEmpty;

class LineWebhookMessage extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_webhook_id",
        "status",

        "type",
        "message_id",
        "quote_token",
        "text",
        "emojis",
        "mention",


        "content_type",
        "content_original_url",
        "content_preview_url",
        "image_id",
        "image_index",
        "image_total",
        "duration",

        "file_name",
        "file_size",

        "title",
        "address",
        "latitude",
        "longitude",

        "sticker_id",
        "package_id",
        "sticker_resource_type",
        "keywords",
    );

    protected $casts    =   array(
        "emojis"    =>  "json",
        "mention"   =>  "json",
        "keywords"  =>  "json",
    );

    public static $statuses =   array(
        "un_replied"        =>  "未返信",
        "replied"           =>  "返信済",
        "no_reply_needed"   =>  "返信不要",
        "automatic_reply"   =>  "自動返信",
        "unsend"            =>  "送信取消",
    );

    public function webhook()
    {
        return $this->belongsTo(LineWebhook::class,"line_webhook_id");
    }

    public function set_values($data)
    {
        $this->type         =   isset($data["type"])        ? $data["type"]         : null;
        $this->message_id   =   isset($data["id"])          ? $data["id"]           : null;
        $this->quote_token  =   isset($data["quoteToken"])  ? $data["quoteToken"]   : null;
        switch($this->type){
            case("text"):
                $this->text     =   isset($data["text"])    ? $data["text"]     : null;
                $this->emojis   =   isset($data["emojis"])  ? $data["emojis"]   : null;
                $this->mention  =   isset($data["mention"]) ? $data["mention"]  : null;
                break;
            case("image"):
                $this->content_type             =   isset($data["contentProvider"], $data["contentProvider"]["type"])               ? $data["contentProvider"]["type"]                  : null;
                $this->content_original_url     =   isset($data["contentProvider"], $data["contentProvider"]["originalContentUrl"]) ? $data["contentProvider"]["originalContentUrl"]    : null;
                $this->content_preview_url      =   isset($data["contentProvider"], $data["contentProvider"]["previewImageUrl"])    ? $data["contentProvider"]["previewImageUrl"]       : null;
                $this->image_id                 =   isset($data["imageSet"], $data["imageSet"]["id"])                               ? $data["imageSet"]["id"]                           : null;
                $this->image_index              =   isset($data["imageSet"], $data["imageSet"]["index"])                            ? $data["imageSet"]["index"]                        : null;
                $this->image_total              =   isset($data["imageSet"], $data["imageSet"]["total"])                            ? $data["imageSet"]["total"]                        : null;
                break;
            case ("movie"):
                $this->duration                 =   isset($data["duration"])                                                        ? $data["duration"]                                 : null;
                $this->content_type             =   isset($data["contentProvider"], $data["contentProvider"]["type"])               ? $data["contentProvider"]["type"]                  : null;
                $this->content_original_url     =   isset($data["contentProvider"], $data["contentProvider"]["originalContentUrl"]) ? $data["contentProvider"]["originalContentUrl"]    : null;
                $this->content_preview_url      =   isset($data["contentProvider"], $data["contentProvider"]["previewImageUrl"])    ? $data["contentProvider"]["previewImageUrl"]       : null;
                break;
            case("audio"):
                $this->duration                 =   isset($data["duration"])                                                        ? $data["duration"]                                 : null;
                $this->content_type             =   isset($data["contentProvider"], $data["contentProvider"]["type"])               ? $data["contentProvider"]["type"]                  : null;
                $this->content_original_url     =   isset($data["contentProvider"], $data["contentProvider"]["originalContentUrl"]) ? $data["contentProvider"]["originalContentUrl"]    : null;
                break;
            case("file"):
                $this->file_name    =   isset($data["fileName"])  ? $data["fileName"]   : null;
                $this->file_size    =   isset($data["fileSize"])  ? $data["fileSize"]   : null;
                break;
            case("location"):
                $this->title        =   isset($data["title"])       ? $data["title"]        : null;
                $this->address      =   isset($data["address"])     ? $data["address"]      : null;
                $this->latitude     =   isset($data["latitude"])    ? $data["latitude"]     : null;
                $this->longitude    =   isset($data["longitude"])   ? $data["longitude"]    : null;
                break;
            case("sticker"):
                $this->sticker_id               =   isset($data["stickerId"])           ? $data["stickerId"]            : null;
                $this->package_id               =   isset($data["packageId"])           ? $data["packageId"]            : null;
                $this->sticker_resource_type    =   isset($data["stickerResourceType"]) ? $data["stickerResourceType"]  : null;
                $this->keywords                 =   isset($data["keywords"])            ? $data["keywords"]             : null;
                $this->text                     =   isset($data["text"])                ? $data["text"]                 : null;
                break;
        }
        $this->save();
    }

    public function automatic_reply($reply_token)
    {
        $message_object_1   =   null;
        $message_object_2   =   null;
        $message_object_3   =   null;
        $message_object_4   =   null;
        $message_object_5   =   null;
        $message_object_1   =   $this->get_message_object("text", "メッセージ自動返答");
        $message_object_2   =   $this->get_message_object("text", "メッセージ自動返答");
        
        if($reply_token && ($message_object_1 || $message_object_2 || $message_object_3 || $message_object_4 || $message_object_5)){
            $line       =   $this->webhook->line;
            $message    =   LineMessage::Create(array(
                "line_id"               =>  $line->id,
                "type"                  =>  "reply",
                "notification_disabled" =>  false,
                "reply_token"           =>  $reply_token,
                "line_user_id"          =>  $this->webhook->line_user_id    ? $this->webhook->line_user_id  : null,
            ));
            $message->set_message_object();
            $response   =   $message->sending();
            if($response->successful()){
                $this->status       =   "automatic_reply";
                $this->save();
            }
        }
    }
    public function get_message_object($type, $name)
    {
        return match($type){

        };
        // return LineMessageObject::whereLineId($this->webhook->line_id)->whereStatus("automatic_reply")->whereType($type)->whereName($name)->first();
    }


    public function get_value()
    {
        switch($this->type){
            case("text"):
                return $this->text;
                break;
            case("image"):
            case("movie"):
            case("audio"):
                switch($this->content_type){
                    case("line"):
                        return $this->get_bot_message_content();
                        break;
                    case("external"):
                        return $this->content_original_url;
                        break;
                }
                break;
            case("file"):
                $this->file_name    =   isset($data["fileName"])  ? $data["fileName"]   : null;
                $this->file_size    =   isset($data["fileSize"])  ? $data["fileSize"]   : null;
                break;
            case("location"):
                if($this->address){
                    return $this->address;
                }
                if($this->latitude && $this->longitude){
                    return "($this->latitude, $this->longitude)";
                }
                if($this->title){
                    return $this->title;
                }
                break;
            case("sticker"):
                return $this->text ."[" . implode(",",$this->keywords) . "]";
                break;
            default:
                return null;
        }
    }
    public function get_bot_message_content()
    {
        $channel_access_token   =   $this->webhook->line->channel_access_token;
        $message_id             =   $this->message_id;
        $headers                =   array(
            "Authorization" => "Bearer ". $channel_access_token,
        );
        $url        =   "https://api-data.line.me/v2/bot/message/$message_id/content";
        $response   =   Http::withHeaders($headers)->get($url);
        if($response->successful()){
            $content_type   =   $response->header("Content-Type");
            return $response;
            return $response->headers();
        } else {
            return "error";
        }
    }


}

