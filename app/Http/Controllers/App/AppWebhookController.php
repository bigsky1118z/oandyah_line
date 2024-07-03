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
}
