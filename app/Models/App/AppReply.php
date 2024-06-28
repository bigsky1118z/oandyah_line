<?php

namespace App\Models\App;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppReply extends Model
{
    use HasFactory;
    protected $fillable =   [
        "id",
        "app_id",
        "name",
        "type",
        "keyword",
        "status",
        "mode",
    ];

    protected $casts    =   [
        "keyword" => "json",
    ];

    public function messages()
    {
        return $this->hasMany(AppReplyMessage::class);
    }
    public function message($app_message_id = null)
    {
        $app_reply_message  =   $this->hasOne(AppReplyMessage::class)->where("id",$app_message_id)->first();
        if(!$app_reply_message){
            $messages_query =   $this->messages()->where("status","active");
            if($this->mode == "latest"){
                $app_reply_message  =   $messages_query->sortByDesc("updated_at")->first();
            }
            if ($this->mode == 'random') {
                $app_reply_message = $messages_query->inRandomOrder()->first();
            }
        }
        return $app_reply_message;
    }


    static $matches    =   array(
        "exact"     =>  "完全一致",
        "forward"   =>  "前方一致",
        "backward"  =>  "後方一致",
        "partial"   =>  "部分一致",
    );
    public function get_match()
    {
        return self::$matches[$this->match] ?? $this->match;
    }

    static $statuses    =   array(
        "active"    =>  "有効",
        "private"   =>  "無効",
        "draft"     =>  "下書き",
    );
    public function get_status()
    {
        return self::$statuses[$this->status] ?? $this->status;
    }
    static $modes    =   array(
        "latest"    =>  "最新メッセージ",
        "random"    =>  "ランダム返答",
    );
    public function get_mode()
    {
        return self::$modes[$this->mode] ?? $this->mode;
    }

    static function get_message_objects($client_id, $type, $text = null)
    {
        $app                =   App::where("client_id", $client_id)->first() ?? new App();
        $reply_query        =   AppReply::where("type",$type)->where("status","active");
        $message_objects    =   array();
        if($type == "follow"){
            $reply              =   $reply_query->first();
            $message_objects    =   $reply->message()->messages ?? array();
        }
        if($type == "message"){
            $reply      =   null;
            $reply      =   $reply ? $reply :   $reply_query->where("match","exact")->whereJsonContains("keyword",$text)->first();
            $reply      =   $reply ? $reply :   $reply_query->where("match","partal")->whereJsonContains("keyword",$text)->first();
            // $reply      =   $reply ? $reply :   $reply_query->where("match","forward")->whereJsonContains("keyword",$text)->first();
            // $reply      =   $reply ? $reply :   $reply_query->where("match","backward")->whereJsonContains("keyword",$text)->first();
            if($reply){
                $message_objects    =   $reply->message()->messages ?? array();
            } else {
                $message_objects    =   array(
                    array(
                        "type"  =>  "text",
                        "text"  =>  "自動返信",
                    ),
                    array(
                        "type"  =>  "text",
                        "text"  =>  $text ?? "失敗",
                    ),
                );
            }
        }
        return $message_objects;
    }
}
