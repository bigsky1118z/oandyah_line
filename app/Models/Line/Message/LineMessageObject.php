<?php

namespace App\Models\Line\Message;

use App\Models\Line\LineMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineMessageObject extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_message_id",
        "status",
        "validate",
        "type",
        "index",
        "line_message_type_id",
    );

    public static $types    =   array(
        "text"      =>  "テキスト",
        "sticker"   =>  "スタンプ",
        "image"     =>  "画像",
        "video"     =>  "動画",
        "audio"     =>  "音声",
        "location"  =>  "位置情報",
        "imagemap"  =>  "画像マップ",
        "template"  =>  "テンプレート",
        "flex"      =>  "フレックス",
    );

    public function line_message()
    {
        return $this->belongsTo(LineMessage::class);
    }
    
    public function get_value($type = null)
    {
        $line   =   isset($this->line_message,$this->line_message->line) ? $this->line_message->line : null;
        if($line){
            $value  =   match($this->type){
                "text"      =>  LineMessageText::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "sticker"   =>  LineMessageSticker::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "image"     =>  LineMessageImage::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "video"     =>  LineMessageVideo::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "audio"     =>  LineMessageAudio::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "location"  =>  LineMessageLocation::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "imagemap"  =>  LineMessageImagemap::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "template"  =>  LineMessageTemplate::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                "flex"      =>  LineMessageFlex::whereLineId($line->id)->whereId($this->line_message_type_id)->latest()->first(),
                default     =>  null,
            };
            if($value){
                return match($type) {
                    "object"    =>  $value->get_object(),
                    "html"      =>  $value->get_html(),
                    "name"      =>  $value->name,
                    default     =>  $value,
                };
            }
        }
        return null;
    }

    public function get_object($friend = null)
    {
        $name   =   $friend ?  $friend->get_name() : "あなた";
        $object =   $this->get_value("object");
        switch($this->type){
            case("text"):
                $object["text"]     =   isset($object["text"])  ? preg_replace('/\$\{name\}/', $name, $object["text"])  : null;
                break;
            case("sticker"):
            case("image"):
            case("video"):
            case("audio"):
                break;
            case("location"):
                $object["title"]    =   isset($object["title"]) ? preg_replace('/\$\{name\}/', $name, $object["title"]) : null;
                break;
            case("imagemap"):
            case("template"):
            case("flex"):
                break;
        }
        return $object;
    }

}
