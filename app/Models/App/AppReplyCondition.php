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


    static function message($app_id, $text = null)
    {
        $conditions =   AppReplyCondition::conditions($app_id, "message");
        $results    =   $conditions->filter(function($condition) use($text) {
            $keyword    =   $condition->condition["keyword"]    ?? null;
            $match      =   $condition->condition["match"]      ?? null;
            switch($match){
                case"partial_match":
                    return false;
                case"exact_match":
                default:
                    return $keyword == $text;
            }
        });
        return $results;
    }

    static function conditions($app_id, $type)
    {
        return AppReplyCondition::whereAppId($app_id)->whereType($type)->whereEnable(true)->get();
    }
}
