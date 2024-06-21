<?php

namespace App\Http\Controllers\App;

use App\Library\MessagingApi;
use App\Models\App;
use App\Models\App\AppFriend;
use App\Models\App\AppWebhook;
use App\Models\User;
use Illuminate\Http\Request;

class AppWebhookController extends Controller
{
    public function index(Request $request, $user_name, $app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name)->app;
        if($user && $app){
            $data   =   array(
                "user"      =>  $user,
                "app"       =>  $app,
                "webhooks"  =>  AppWebhook::whereAppId($app->id)->get(),
            );
            return view("app.webhook.index", $data);
        } else {
            return redirect("/");
        }
    }

    public function show(Request $request, $user_name, $app_name, $id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($app_name);
        return AppWebhook::whereAppId($app->id)->whereId($id)->first();
    }

    /** 外部アクセス */
    public function get(Request $request, $app_name)
    {
        return $app_name;
    }

    public function post(Request $request, $client_id)
    {
        return response()->json([],200);
        /** 署名を検証 */
        $app                =   App::where("client_id",$client_id)->first();
        $request_body       =   $request->getContent();
        $channel_secret     =   $app->channel_secret ?? null;
        $x_line_signature   =   $request->header("x_line_signature");
        $validation         =   MessagingApi::signature_validation($request_body, $channel_secret, $x_line_signature);
        if($validation && $request->exists("events")){
            $events =   $request->get("events");
            foreach($events as $event){
                $webhook    =   AppWebhook::updateOrCreate(array(
                    "app_id"            =>  $app->id,
                    "ip_address"        =>  $request->header("x-forwarded-for"),
                    "request_host"      =>  $request->host(),
                    "request_path"      =>  $request->path(),
                    "request_method"    =>  $request->method(),
                    "request_body"      =>  $request_body,
                    "x_line_signature"  =>  $x_line_signature,
                    "destination"       =>  $request->get("destination"),
                    "query_string"      =>  $request->get("query_string"),
                    "event"             =>  $event,
                ));
                $friend     =   $webhook->get_friend()->latest();
                $response   =   $webhook->auto_response();
                // $webhook->response_status   =   $response;
                // $webhook->save();
            }
            $data   =   array();
            return response()->json($data,200);
        } else {
            return back();
        }
    }




    // public function webhook(Request $request, $user_name, $app_name)
    // {
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
