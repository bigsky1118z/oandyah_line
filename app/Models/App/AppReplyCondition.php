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


    static function find_message($app_id, $type, $text = null)
    {
        $conditions =   AppReplyCondition::whereAppId($app_id)->whereType($type)->whereEnable(true)->get();;
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
}