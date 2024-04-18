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

    static function get_keywords($app_id)
    {
        $conditions =   AppReplyCondition::whereAppId($app_id)->whereType("message")->whereEnable(true)->whereNotNull("condition->keyword")->get();
        $keywords   =   $conditions->pluck("condition");
        return $keywords;

    }
}
