<?php

namespace App\Http\Controllers\App;

use App\Models\App\App;
use App\Models\App\AppWebhook;
use App\Models\User;
use Illuminate\Http\Request;

class AppWebhookController extends Controller
{
    public function post(Request $request, $user_name, $app_name)
    {
        $user   =   User::whereUserName($user_name)->first();
        $app    =   App::whereAppName($app_name)->first();
        if($user && $app && $user->id == $app->user_id){
            $webhook    =   AppWebhook::updateOrCreate(array(
                "app_id"            =>  $app->id,
                "ip_address"        =>  $request->header("x-forwarded-for"),
                "request_host"      =>  $request->host(),
                "request_path"      =>  $request->path(),
                "request_method"    =>  $request->method(),
                "x_line_signature"  =>  $request->header("x_line_signature"),
                "destination"       =>  $request->get("destination"),
                "query_string"      =>  $request->get("query_string"),
                "event"             =>  $request->get("events") ?? null,
            ));
            $webhook->mode  =   "A";
            
            if($request->exists("events")){
                $webhook->mode  =   "B";
                $events         =   $request->get("events");
                $webhook->type  =   gettype($events);
                $webhook->save();

                // ここではじかれている
                if(!empty($events)){
                    $webhook->mode  =   "C";

                    foreach($events as $event){
                        // $webhook->line_user_id      =   $event["source"]["userId"]                  ??  null;
                        // $webhook->line_group_id     =   $event["source"]["groupId"]                 ??  null;
                        // $webhook->line_room_id      =   $event["source"]["roomId"]                  ??  null;
                        // $webhook->type              =   $event["type"]                              ??  null;
                        // $webhook->mode              =   $event["mode"]                              ??  null;
                        // $webhook->Receive_erent_id  =   $event["ReceiverventId"]                    ??  null;
                        // $webhook->reply_token       =   $event["replyToken"]                        ??  null;
                        // $webhook->is_redelivery     =   $event['deliveryContext']['isRedelivery']   ??  null;
                        // $webhook->event             =   $event[$event["type"]]                      ??  null;

                        isset($event["source"]["userId"])                   ?   $webhook->line_user_id      =   $event["source"]["userId"]                  :   null;
                        isset($event["source"]["groupId"])                  ?   $webhook->line_group_id     =   $event["source"]["groupId"]                 :   null;
                        isset($event["source"]["roomId"])                   ?   $webhook->line_room_id      =   $event["source"]["roomId"]                  :   null;
                        isset($event["type"])                               ?   $webhook->type              =   $event["type"]                              :   null;
                        isset($event["mode"])                               ?   $webhook->mode              =   $event["mode"]                              :   null;
                        isset($event["ReceiverventId"])                     ?   $webhook->Receive_erent_id  =   $event["ReceiverventId"]                    :   null;
                        isset($event["replyToken"])                         ?   $webhook->reply_token       =   $event["replyToken"]                        :   null;
                        isset($event['deliveryContext']['isRedelivery'])    ?   $webhook->is_redelivery     =   $event['deliveryContext']['isRedelivery']   :   null;
                        isset($event[$event["type"]])                       ?   $webhook->event             =   $event[$event["type"]]                      :   null;
                    }
                }
            }
            $webhook->save();
        }
        return response()->json([],200);
    }

    public function index(Request $request, $user_name, $app_name)
    {
        $data   =   array(
            "webhooks"  =>  AppWebhook::all(),
        );
        return view("app.webhook.index", $data);
    }


    // public function index($line_name)
    // {
    //     $user   =   auth()->user();
    //     if(!$user){
    //         return redirect("/line");
    //     }
    //     $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
    //     if(!$line){
    //         return redirect("/line");
    //     }
    //     $data   =   array(
    //         "line"  =>  $line,
    //     );
    //     return view("line.webhook.index", $data);
    //     // return LineWebhook::all();
    //     return LineWebhook::whereType("message")->latest()->first()->message->get_value();
    //     // return LineWebhook::whereType("message")->latest()->first()->message->webhook->line;
    //     // return LineWebhook::whereLineId($line->id)->get();
    // }

    // public function webhook(Request $request, $user_name, $app_name)
    // {
    //     $line       =   Line::whereName($line_name)->first();
    //     $webhook    =   LineWebhook::Create(array(
    //         "line_id"           =>   $line->id,
    //         "ip_address"        =>   $request->header("x-forwarded-for"),
    //         "request_host"      =>   $request->host(),
    //         "request_path"      =>   $request->path(),
    //         "request_method"    =>   $request->method(),
    //         "x_line_signature"  =>   $request->header("x_line_signature"),
    //         "destination"       =>   $request->get("destination"),
    //         "query_string"      =>   $request->get("query_string"),
    //     ));
    //     if($request->exists("events")){
    //         $events =   $request->get("events");
    //         if(!empty($events)){
    //             foreach($events as $event){
    //                 isset($event["source"]["userId"])                   ?   $webhook->line_user_id      =   $event["source"]["userId"]                  :   null;
    //                 isset($event["source"]["groupId"])                  ?   $webhook->line_group_id     =   $event["source"]["groupId"]                 :   null;
    //                 isset($event["source"]["roomId"])                   ?   $webhook->line_room_id      =   $event["source"]["roomId"]                  :   null;
    //                 isset($event["type"])                               ?   $webhook->type              =   $event["type"]                              :   null;
    //                 isset($event["mode"])                               ?   $webhook->mode              =   $event["mode"]                              :   null;
    //                 isset($event["ReceiverventId"])                     ?   $webhook->Receive_erent_id  =   $event["ReceiverventId"]                    :   null;
    //                 isset($event["replyToken"])                         ?   $webhook->reply_token       =   $event["replyToken"]                        :   null;
    //                 isset($event['deliveryContext']['isRedelivery'])    ?   $webhook->is_redelivery     =   $event['deliveryContext']['isRedelivery']   :   null;
    //                 isset($event[$event["type"]])                       ?   $webhook->event             =   $event[$event["type"]]                      :   null;
    //             }
    //         }
    //     }
    //     $webhook->save();
    //     if(isset($webhook->line_user_id) && $webhook->friend()->doesntExist()){
    //         $friend =   LineFriend::updateOrCreate(array(
    //             "line_id"       =>  $webhook->line_id,
    //             "line_user_id"  =>  $webhook->line_user_id,
    //         ));
    //         $friend->get_bot_profile();
    //     }
    //     switch($webhook->type){
    //         case "message":
    //             if(isset($webhook->event)){
    //                 $message    =   LineWebhookMessage::Create(array(
    //                     "line_webhook_id"   =>  $webhook->id,
    //                     "status"            =>  "un_replied",
    //                 ));
    //                 $message->set_values($webhook->event);
    //                 $message->automatic_reply($webhook->reply_token);
    //             }
    //             break;
    //         case "unsend":
    //             if(isset($webhook->event["messageId"]))
    //                 $message    =   LineWebhookMessage::whereMessageId($webhook->event["messageId"])->first();
    //                 if($message && $message->webhook->line_id == $webhook->line_id){
    //                     $message->status    =   "unsend";
    //                     $message->save();
    //                 }
    //             break;
    //         case "follow":
    //         case "unfollow":
    //             $webhook->friend->get_bot_profile();
    //             break;
    //         case "join":
    //         case "leave":
    //             break;
    //         case "memberJoined":
    //         case "memberLeft":
    //             break;
    //         case "postback":
    //                 $postback   =   LineWebhookPostback::Create(array(
    //                     "line_webhook_id"   =>  $webhook->id,
    //                     "status"            =>  "un_replied",
    //                 ));
    //                 $postback->set_values($webhook->event);
    //                 $postback->automatic_reply($webhook->reply_token);
    //             break;
    //         case "videoPlayComplete":
    //             break;
    //         case "beacon":
    //             break;
    //         case "accountLink":
    //             break;
    //         case "things":
    //             break;
    //         }
    // }

    // public function type($line_name, $type)
    // {
    //     $user   =   auth()->user();
    //     if(!$user){
    //         return redirect("/line");
    //     }
    //     $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
    //     if(!$line){
    //         return redirect("/line");
    //     }
    //     $data   =   array(
    //         "line"      =>  $line,
    //     );
    //     if(file_exists(resource_path("views/line/webhook/type/$type.blade.php"))){
    //     // if(file_exists(view("line.webhook.type.$type")->getPath()){
    //             return view("line.webhook.type.$type", $data);
    //     } else {
    //         return redirect("/line/$line->name/webhook");
    //     }
    // }
}
