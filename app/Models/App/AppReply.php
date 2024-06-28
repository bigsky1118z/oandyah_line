<?php

namespace App\Models\App;

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
    ];

    protected $casts    =   [
        "keyword" => "json",
    ];

    public function message()
    {
        return $this->hasMany(AppReplyMessage::class);
    }

    static $matches    =   array(
        "exact"     =>  "完全一致",
        "backward"  =>  "後方一致",
        "forward"   =>  "前方一致",
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

    static function get_message_objects($type, $text = null)
    {
        $replies    =   AppReply::where("type",$type)->where("status","active")->get();
    }
}
