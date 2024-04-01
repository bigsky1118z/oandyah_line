<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppAuto extends Model
{
    use HasFactory;

    static function reply($webhook)
    {
        $app    =   $webhook->app;
        $type   =   $webhook->type;
        return $webhook;
        $auto   =   AppAuto::whereAppId($app->id)->whereType($type);
        switch($type){
            case "message" :

        }

        $app    =   $webhook->app;
        switch($webhook->type){
            case("message"):
                $response   =   AppMessage::post_bot_message_reply($app,$webhook->reply_token);
                break;
            }
        $webhook->response_status  =   $response->status();
        $webhook->save();
        return $response;
    }

    static function judgement($webhook)
    {
        $type       =   $webhook->type;
        $key        =   $type == "message"  ?   $webhook->event("message")
                    :   ($type == "postback" ?   $webhook->event("postback")    
                    :   "");
        $judgement  =   AppAuto::whereType($type)->where();

    }

}
