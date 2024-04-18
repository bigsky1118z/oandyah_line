<?php

namespace App\Models\App;

use App\Models\App;
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

    public function reply()
    {
        return $this->belongsTo(AppReply::class, "app_reply_id", "id");
    }

    static $matches =   array(
        "forward_match"     =>  "前方一致",
        "backward_match"    =>  "後方一致",
        "partial_match"     =>  "部分一致",
        "exact_match"       =>  "完全一致",
    );
    public function get_match()
    {
        $match  =   $this->condition["match"] ?? null;
        return self::$matches[$match] ?? null;
    }

    static function find_reply_follow($app_id, $refollow = false)
    {
        $query      =   AppReplyCondition::whereAppId($app_id)->whereType("follow")->whereEnable(true)->orderBy("priority")->orderByDesc("id")->get();
        if($refollow){
            $query->where("condition->refollow",true);
        }
        $condition  =   $query->first();
        return $condition->reply ?? new AppReply();
    }


    static function find_reply_message($app_id, $text = null)
    {
        $conditions =   AppReplyCondition::whereAppId($app_id)->whereType("message")->whereEnable(true)->orderBy("priority")->orderByDesc("id")->get();
        $condition  =   $conditions->filter(function($condition) use($text) {
            $keyword    =   $condition->condition["keyword"]    ?? null;
            $match      =   $condition->condition["match"]      ?? null;
            switch($match){
                case "forward_match":
                    return strpos($text, $keyword) === 0;
                case "backward_match":
                    $keyword_length = strlen($keyword);
                    $text_length    = strlen($text);
                    return $keyword_length <= $text_length ? substr($text, -$keyword_length) === $keyword : false;
                case "partial_match":
                    return strpos($text, $keyword) !== false;
                case "exact_match":
                default:
                    return $keyword == $text;
            }
        })->first();
        return $condition->reply ?? new AppReply();
    }

    static function find_reply_postback($app_id, $data = null)
    {
        parse_str($data, $params);
        $query  =   AppReplyCondition::whereAppId($app_id)->whereType("postback")->whereEnable(true)->orderBy("priority")->orderByDesc("id");
        $query->when(isset($params["function"]),fn($query)=> $query->where("condition->function",$params["function"]));
        $condition  =   $query->first();
        return $condition->reply ?? new AppReply();
    }
}