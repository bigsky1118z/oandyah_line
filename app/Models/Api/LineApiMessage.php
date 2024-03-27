<?php

namespace App\Models\Api;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiMessage extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "category",
        "name",
        "status",

        "type",
        "text",
        "emojis",
        "package_id",
        "sticker_id",
        "original_content_url",
        "preview_image_url",
        "tracking_id",
        "duration",
        "title",
        "address",
        "latitude",
        "longitude",
        "alt_text",
        "base_url",
        "base_size",
        "video",
        "actions",
        "template",
        "contents",
    );

    protected $casts    =   array(
        "message"   =>  'json',
        "emojis"    =>  'json',
        "base_size" =>  'json',
        "video"     =>  'json',
        "actions"   =>  'json',
        "template"  =>  'json',
        "contents"  =>  'json',
    );

    public function get_message_object()
    {
        $message_object =   array(
            "type"  =>  $this->type,
        );
        switch($this->type){
            case("text") :
                $message_object["text"]         =   $this->text;
                if($this->emojis){
                    $message_object["emojis"]   =   $this->emojis;
                }
                break;
            case("sticker") :
                $message_object["packageId"]    =   $this->package_id;
                $message_object["stickerId"]    =   $this->sticker_id;
                break;
            case("image") :
                $message_object["originalContentUrl"]   =   $this->original_content_url;
                $message_object["previewImageUrl"]      =   $this->preview_image_url;
                break;
            case("video") :
                $message_object["originalContentUrl"]   =   $this->original_content_url;
                $message_object["previewImageUrl"]      =   $this->preview_image_url;
                if($this->tracking_id){
                    $message_object["trackingId"]       =   $this->tracking_id;
                }
                break;
            case("audio") :
                $message_object["originalContentUrl"]   =   $this->original_content_url;
                $message_object["duration"]             =   $this->duration;
                break;
            case("location") :
                $message_object["title"]        =   $this->title;
                $message_object["address"]      =   $this->address;
                $message_object["latitude"]     =   $this->latitude;
                $message_object["longitude"]    =   $this->longitude;
                break;
            case("imagemap") :
                $message_object["altText"]      =   $this->alt_text;
                $message_object["baseUrl"]      =   $this->base_url;
                $message_object["baseSize"]     =   $this->base_size;
                if($this->video){
                    $message_object["video"]    =   $this->video;
                }
                $message_object["actions"]      =   $this->actions;
                break;
            case("template") :
                $message_object["altText"]  =   $this->alt_text;
                $message_object["template"] =   $this->template;
                break;
            case("flex") :
                $message_object["altText"]  =   $this->alt_text;
                $message_object["contents"] =   $this->contents;
                break;
        }
        return $message_object;
    }

    public function get_preview($limit = null)
    {
        $preview    =   "<dl class='message-object $this->type'>";
        switch($this->type){
            case("text") :
                $preview    .=   "<dd class='text'>";
                $preview    .=   $limit == null ? $this->text : mb_strimwidth($this->text, 0, $limit, "...");
                $preview    .=   "</dd>";
                break;
            case("sticker") :
                // $preview   .=   "";
                break;
            case("image") :
                foreach(["original_content_url", "preview_image_url"] as $image){
                    $preview    .=  "<dd class=$image>";
                        $preview    .=  "<dl>";
                        $preview    .=  "<dd><img src='$this[$image]' /></dd>";
                        $preview    .=  "<dt>";
                        $preview    .=  $image == "original_content_url" ? "メイン" : "プレビュー";
                        $preview    .=  "</dt>";
                        $preview    .=  "</dl>";
                    $preview    .=  "</dd>";
                }
                break;
            case("video") :
                break;
            case("audio") :
                break;
            case("location") :
                $preview    .=  "<dd class='latitude'>";
                    $preview    .=  "<dl class='dl-flex-center'>";
                        $preview    .=  "<dt>緯度</dt><dd>$this->latitude</dd>";
                    $preview    .=  "</dl>";
                $preview    .=  "</dd>";
                $preview    .=  "<dd class='longitude'>";
                    $preview    .=  "<dl class='dl-flex-center'>";
                        $preview    .=  "<dt>経度</dt><dd>$this->longitude</dd>";
                    $preview    .=  "</dl>";
                $preview    .=  "</dd>";
                $preview    .=  "<dd class='map'><a href='https://www.google.co.jp/maps/place/@$this->latitude,$this->longitude' target='_blank' rel='noopener noreferrer'>地図を確認する</a></dd>";
                $preview    .=  "<dd class='title'>$this->title</dd>";
                $preview    .=  "<dd class='address'>$this->address</dd>";
                break;
            case("imagemap") :
                // $preview   .=   "";
                break;
            case("template") :
                $preview    .=  "<dd class='alt_text'>$this->alt_text</dd>";
                $preview    .=  "<dd class='template-" . $this->template['type'] . "'>";
                    switch($this->template['type']){
                        case ("buttons"):
                            $preview    .=  "<dl>";
                                if(isset($this->template["title"])){
                                    $preview    .=  "<dd class='template-title'>" . $this->template["title"] . "</dd>";
                                    $preview    .=  "<dd class='template-text'>" . $this->template["text"] . "</dd>";
                                }else{
                                    $preview    .=  "<dd class='template-text-only'>" . $this->template["text"] . "</dd>";
                                }
                                $preview    .=  "<dd class='template-actions'>";
                                    $preview    .=  "<dl>";
                                        foreach($this->template["actions"] as $action){
                                            $preview    .=  "<dd class='template-actions-label'>" . $action["label"] . "</dd>";
                                        }
                                    $preview    .=  "</dl>";
                                $preview    .=  "</dd>";
                            $preview    .=  "</dl>";
                            break;
                        case ("confirm"):
                            $preview    .=  "<dl>";
                                $preview    .=  "<dd class='template-text'>" . $this->template["text"] . "</dd>";
                                $preview    .=  "<dd class='template-actions'>";
                                    $preview    .=  "<dl>";
                                        foreach($this->template["actions"] as $action){
                                            $preview    .=  "<dd class='template-actions-label'>" . $action["label"] . "</dd>";
                                        }
                                    $preview    .=  "</dl>";
                                $preview    .=  "</dd>";
                            $preview    .=  "</dl>";
                            break;
                        case ("carousel"):
                            $preview   .=   "";
                            break;
                        case ("image_carousel"):
                            $preview   .=   "";
                            break;
                    }
                    $preview    .=  "</dd>";
                break;
            // case("flex") :
            //     break;
        }
        $preview    .=   "</dl>";
        return $preview;
    }



    public function get_message_object_for_send()
    {
        $message_object = $this->get_message_object();
        $message_object_for_send    =   $this->flatten_object($message_object, "][");
        return $message_object_for_send;
    }
        public function flatten_object($array, $separator = null, $prefix = '')
        {
            $result = array();
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $nestedKeys = $this->flatten_object($value, $separator, $prefix . $key . $separator);
                    $result = array_merge($result, $nestedKeys);
                } else {
                    $result[$prefix . $key] = $value;
                }
            }
            return $result;
        }

    public function get_message_type ()
    {
        $message_types  =   array(
            "text"                      =>  "テキスト",
            "sticker"                   =>  "スタンプ",
            "image"                     =>  "画像",
            "video"                     =>  "映像",
            "audio"                     =>  "音声",
            "location"                  =>  "位置情報",
            "imagemap"                  =>  "",
            "buttons"                   =>  "選択ボタン",
            "confirm"                   =>  "二択ボタン",
            "carousel"                  =>  "カルーセル",
            "image_carousel"            =>  "画像カルーセル",
            "template_buttons"          =>  "選択ボタン",
            "template_confirm"          =>  "二択ボタン",
            "template_carousel"         =>  "カルーセル",
            "template_image_carousel"   =>  "画像カルーセル",
            "flex_bubble"               =>  "フレックス",
        );
        return $this->type == "template" ? $message_types[$this->template["type"]] : $message_types[$this->type];
    }
    

    public static function get_message_form($type)
    {
        $data       =   array();
        $get_form   =   function($name, $node, $type = null, $options = array(),$title = null){
            $form   =   array();
            $name       ?   $form["name"]       =   $name       :   null;
            $name       ?   $form["id"]         =   $name       :   null;
            $node       ?   $form["node"]       =   $node       :   null;
            $type       ?   $form["type"]       =   $type       :   null;
            $options    ?   $form["options"]    =   $options    :   null;
            $title      ?   $form["title"]      =   $title      :   null;
            return $form;
        };
        $action_types  =   array(
            ""  =>  "---",
            "message"   =>  "メッセージ",
            "postback"  =>  "ポストバック",
            "uri"       =>  "ウェブサイト",
            "datetimepicker_date"       =>  "日付",
            "datetimepicker_time"       =>  "時間",
            "datetimepicker_datetime"   =>  "日時",
        );
        switch($type){
            case("text"):
                $options    =   array(
                    "rows"      =>  30,
                    "maxlength" =>  5000,
                    "required"  =>  true,
                );
                $data[] =   $get_form("text", "textarea", null, $options, "メッセージ");
                break;
            case("image"):
                $button_options =   array(
                    "class"         =>  "unselect",
                    "onclick"       =>  "imageSelectButton(this);",
                    "textContent"   =>  "画像選択",
                );
                $input_options  =   array(
                    "accept"    =>  "image/*",
                    "onchange"  =>  "imageSelect(this);",
                    "style"     =>  "display:none;",
                    "required"  =>  true,
                );
                $data[] =   array(
                    $get_form("originalContentUrl", "input", "text", $input_options, "メイン画像"),
                    $get_form(null, "button", "button", $button_options),
                );
                $input_options["required"]    =   false;
                $data[] =   array(
                    $get_form("previewImageUrl", "input", "text", $input_options, "プレビュー画像"),
                    $get_form(null, "button", "button", $button_options),
                );
                break;
            case("location"):
                $options    =   array(
                    "required"  =>  true,
                );
                $data[] =   $get_form("title", "input", "text", $options, "場所");
                $options["oninput"] =   "getGeocoding(this);";
                $data[] =   array(
                    $get_form("address", "input", "text", $options, "住所"),
                    $get_form("latitude", "input", "hidden"),
                    $get_form("longitude", "input", "hidden"),
                );
                break;
            case("template_buttons"):
                $options    =   array(
                    "required"  =>  true,
                );
                $select_options =   array(
                    "class"     =>  "addAction",
                    "onchange"  =>  "addContent(this, 'create-message-object-action');",
                );
                $button_options =   array(
                    "class"     =>  "editContent hidden",
                );
                $data[] =   $get_form("altText", "input", "text", $options, "端末の通知やトークリストで表示するテキスト");
                $data[] =   $get_form("template-title", "input", "text", $options, "タイトル");
                $data[] =   $get_form("template-text", "input", "text", $options, "メッセージ");
                $data[] =   $get_form("template-defaultAction-type", "select", $action_types, $select_options,"デフォルトアクション");
                foreach(range(0,3) as $number){
                    if($number == 0){
                        $options["required"] =   true;
                        $select_options["required"] =   true;
                    } else {
                        unset($options["required"]);
                        unset($select_options["required"]);
                    }
                    $data[] =   array(
                        $get_form("template-actions-$number-label", "input", "text", $options, "アクション" . $number+1),
                        $get_form("template-actions-$number-type", "select", $action_types, $select_options),
                        $get_form(null, "button", "button", $button_options),
                    );
                }
                break;
            case("template_confirm"):
                $options    =   array(
                    "required"  =>  true,
                );
                $data[] =   $get_form("altText", "input", "text", $options, "端末の通知やトークリストで表示するテキスト");
                $data[] =   $get_form("template-text", "input", "text", $options, "確認メッセージ");
                $button_options =   array(
                    "onchange"  =>  "addContent(this, 'create-message-object-action');",
                );
                foreach(range(0,1) as $number){
                    $data[] =   array(
                        $get_form("template-actions-$number-label", "input", "text", $options, "アクション" . $number+1),
                        $get_form("template-actions-$number-type", "select", $action_types, $button_options),
                    );
                }
                break;
            case("action_message"):
                $options    =   array(
                    "rows"      =>  30,
                    "maxlength" =>  5000,
                    "required"  =>  true,
                );
                $data[] =   $get_form("message", "textarea", null, $options, "メッセージ");
                break;
        }
        $save_button    =   array(
            "class"         =>  "saveButton",
            "textContent"   =>  "保存",
            "onclick"       =>  "saveContent(this);",
        );
        $cansel_button  =   array(
            "class"         =>  "canselButton",
            "textContent"   =>  "キャンセル",
            "onclick"       =>  "canselContent(this);",
        );
        $data[] =   array(
            $get_form(null, "button", "button",$save_button),
            $get_form(null, "button", "button",$cansel_button),
        );
        return  $data;
    }
}
