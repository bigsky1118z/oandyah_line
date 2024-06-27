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
    public function index(Request $request, $user_name, $client_id)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app ?? new App();
        $webhooks   =   $app->webhooks;
        $data   =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "webhooks"  =>  $webhooks,
        );
        return view("app.webhook.index", $data);
    }

    public function show(Request $request, $user_name, $client_id, $webhook_id)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app ?? new App();
        $webhook    =   $app->webhook($webhook_id);
        $data   =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "webhook"   =>  $webhook,
        );
        return view("app.webhook.show", $data);
    }

    /** 外部アクセス */
    public function get(Request $request, $client_id)
    {
        return $client_id;
    }

    public function post(Request $request, $client_id)
    {
        $app                =   App::where("client_id",$client_id)->first();
        /** 署名を検証 */
        $request_body       =   $request->getContent();
        $channel_secret     =   $app->channel_secret ?? null;
        $x_line_signature   =   $request->header("x_line_signature");
        $validation         =   MessagingApi::signature_validation($request_body, $channel_secret, $x_line_signature);
        /** eventsの処理 */
        if($validation && $request->exists("events")){
            $events =   $request->get("events");
            foreach($events as $event){
                /** AppWebhookの作成 */
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
                /** AppFriendの更新 */
                $friend     =   $webhook->get_friend();
                $friend->latest();
                /** 自動返信 */
                $webhook->reaction();
            }
            $data   =   array();
            return response()->json($data,200);
        } else {
            return back();
        }
    }




    // public function webhook(Request $request, $user_name, $client_id)
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
