<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppReplyCondition extends Model
{
    use HasFactory;
    protected $fillable =   [
        "app_id",
        "app_reply_id",
        "type",
        "condition",
        "priority",
        "enable",
        "default",
    ];

    protected $casts    =   [
        "condition" =>  "json",
        "enable"    =>  "boolean",
        "default"   =>  "boolean",
    ];


    static function message($app_id, $text)
    {
        $conditions =   AppReplyCondition::conditions($app_id, "message");
        $keywords   =   $conditions->pluck("condition")->map(fn($condition)=>$condition["keyword"] ?? null)->filter(fn($condition)=>$condition);
        return $keywords;
    }

    static function conditions($app_id, $type)
    {
        return AppReplyCondition::whereAppId($app_id)->whereType($type)->whereEnable(true)->get();
    }
}
