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
        $conditions =   AppReplyCondition::whereAppId($app_id)->whereType($type)->whereEnable(true)->get();
        $results    =   $conditions->filter(function($condition) use($text) {
            $keyword    =   $condition->condition["keyword"]    ?? null;
            $match      =   $condition->condition["match"]      ?? null;
            switch($match){
                case "forward_match":
                    return strpos($text, $keyword) === 0;
                case "backward_match":
                    $keyword_length = strlen($keyword);
                    $text_length    = strlen($text);
                    return $keyword_length <= $text_length ? substr($text, -$keyword_length) === $keyword : false;
               case"partial_match":
                    return strpos($text, $keyword) !== false;
                case"exact_match":
                default:
                    return $keyword == $text;
            }
        })->sortBy("priority");
        return $results;
    }
}