<?php
namespace App\Services\Api;

use App\Models\Api\LineApi;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiEvent;
use App\Models\Api\LineApiMessage;
use App\Models\Api\LineApiUser;
use App\Models\Api\LineApiReceive;
use App\Models\Api\LineApiReply;
use App\Models\Api\LineApiReplyFollow;
use App\Models\Api\LineApiSend;
use App\Models\Api\LineApiOrder;
use App\Models\Api\LineApiOrderUser;
use App\Models\Api\LineApiUserTable;
use DateTime;
use getID3;
use Hamcrest\Arrays\IsArray;
use Hamcrest\Type\IsString;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Whoops\Run;

use function Pest\Laravel\put;
use function Pest\Laravel\swap;
use function PHPUnit\Framework\isEmpty;

class LineApiService
{
    /** receive webhook */
        public function receive($request, $channel_name)
        {
            $response   =   null;
            $receive    =   new LineApiReceive(array(
                "channel_name"      =>   $channel_name,
                "ip_address"        =>   $request->header("x-forwarded-for"),
                "request_host"      =>   $request->host(),
                "request_path"      =>   $request->path(),
                "request_method"    =>   $request->method(),
                "x_line_signature"  =>   $request->header("x_line_signature"),
                "destination"       =>   $request->get("destination"),
                "query_string"      =>   $request->get("query_string"),            
            ));
            // events がある場合
            if($request->exists('events')){
                $events =   $request->get("events");
                // events の中身を記録する
                if(!empty($events)){
                    foreach($events as $event){
                        if(isset($event["source"])){
                            switch($event["source"]["type"]){
                                case("group"):
                                    $receive->line_group_id =   $event["source"]["groupId"];
                                case("user"):
                                    $receive->line_user_id  =   $event["source"]["userId"];
                                    if(!$receive->user()->exists()){
                                        $user   =   new LineApiUser(array(
                                            "channel_name"  =>  $receive->channel_name,
                                            "line_user_id"  =>  $receive->line_user_id,
                                        ));
                                        $user->save();
                                        LineApiEvent::add_new_user($channel_name, $user->id);
                                    }
                                    $receive->user->get_present_profile($receive->type);
                                    break;
                            }
                        }
                        if(isset($event["type"])){
                            $receive->type     =   $event["type"];
                            switch($event['type']){
                                case "message"  :
                                    if(isset($event["message"])){
                                        $receive->event =   $event["message"];
                                        if(isset($event["message"]["text"])){
                                            $receive->message =   $event["message"]["text"];
                                        }
                                    }
                                    break;
                                case "postback"  :
                                    if(isset($event["postback"])){
                                        $receive->event =   $event["postback"];
                                        if(isset($event["postback"]["data"])){
                                            $postback   =   $event["postback"]["data"];
                                            $receive->postback  =   $postback;
                                            parse_str($postback, $data);
                                            if($data["action"] == "order" && isset($data["name"])){
                                                if(isset($data["value"]) && $data["value"] == "order"){
                                                    $line_api_order =   new LineApiOrder(array(
                                                        "channel_name"              =>  $receive->channel_name,
                                                        "name"                      =>  $data["name"],
                                                        "line_api_user_id"          =>  (int) $receive->user->id,
                                                        "line_api_order_menu_id"    =>  (int) $data["menu"],
                                                        "price"                     =>  (int) $data["price"],
                                                        "status"                    =>  "未提供",
                                                    ));
                                                    $line_api_order->save();
                                                }
                                                if(isset($data["table"]) && isset($data["value"]) && $data["value"] == "regist"){
                                                    $line_api_user_table    =   LineApiOrderUser::whereChannelName($receive->channel_name)->whereLineApiUserId((int) $receive->user->id)->first();
                                                    if(!$line_api_user_table){
                                                        $line_api_user_table    =   new LineApiOrderUser(array(
                                                            "channel_name"      =>  $receive->channel_name,
                                                            "line_api_user_id"  =>  (int) $receive->user->id,
                                                        ));
                                                    }
                                                    $line_api_user_table["table"]   =  $data["table"];
                                                    $line_api_user_table->save();
                                                }
                                            }
                                        }
                                    }
                                    break;

                                case "memberJoined" :
                                    if(isset($event["jioned"])){
                                        $receive->event =   $event["jioned"];
                                    }
                                    break;
                                case "memberLeft" :
                                    if(isset($event["left"])){
                                        $receive->event =   $event["left"];
                                    }
                                    break;
                                case "accountLink" :
                                    if(isset($event["link"])){
                                        $receive->event =   $event["link"];
                                    }
                                    break;
                                default :
                                    if(isset($event[$event['type']])){
                                        $receive->event =   $event[$event["type"]];
                                    }
                                    break;
                            }
                        }
                        if(isset($event["mode"])){
                            $receive->mode =   $event["mode"];
                        }
                        if(isset($event["ReceiverventId"])){
                            $receive->Receive_erent_id   =   $event["ReceiverventId"];
                        }
                        if(isset($event["replyToken"])){
                            $receive->reply_token   =   $event["replyToken"];
                        }
                        if(isset($event['deliveryContext']['isRedelivery'])){
                            $receive->is_redelivery  =   $event['deliveryContext']['isRedelivery'];
                        }
                    }
                }
                // 条件に応じて reply 用の messages を取得する
                $reply  =   $receive->get_reply();

                if($reply){
                    $send   =   new LineApiSend(array(
                        "channel_name"          =>  $channel_name,
                        "request_metod"         =>  "POST",
                        "endpoint_type"         =>  "reply",
                        "api_endpoint"          =>  $this->get_message_url("reply"),
                        // "messages"              =>  $reply->messages,
                        "line_api_message_1_id" =>  $reply->line_api_message_1_id,
                        "line_api_message_2_id" =>  $reply->line_api_message_2_id,
                        "line_api_message_3_id" =>  $reply->line_api_message_3_id,
                        "line_api_message_4_id" =>  $reply->line_api_message_4_id,
                        "line_api_message_5_id" =>  $reply->line_api_message_5_id,
                        "status"                =>  "reply",
                        "schedule_at"           =>  (new DateTime())->format('Y/m/d H:i:s'),
                        "notification_disabled" =>  $reply->notification_disabled ? true : false,
                        "to"                    =>  $receive->line_user_id,
                        "reply_token"           =>  $receive->reply_token,
                    ));
                    $receive->save();
                    $send->validate();
                    $send   =   $send->sending($send);
                    $receive->save();
                    $receive->response_status   =   $send->response_status;
                }
            }
            $receive->save();
            return $response;
        }
    
    /** send message */
        public function send ($request, $channel_name)
        {
            $send_object    =   array(
                "channel_name"  =>  $channel_name,
                "request_metod" =>  "POST",
                "endpoint_type" =>  $request->endpoint['type'],
                "api_endpoint"  =>  $this->get_message_url($request->endpoint['type']),
                "messages"      =>  $this->generate_message_objects($request->messages, $channel_name),
                "status"        =>  "error",
            );
            // return $send_object["messages"];
            if($request->schedule){
                if(isset($request->schedule['type'])){
                    $send_object['status']  =   $request->schedule['type'];
                    if($request->schedule['type']=="realtime"){
                        $send_object['schedule_at'] =   (new DateTime())->format('Y/m/d H:i:s');
                    }
                    if($request->schedule['type']=="reserve"){
                        if(isset($request->schedule['datetime'])){
                            $send_object['schedule_at'] =   $request->schedule['datetime'];
                        }
                    }
                }
            }

            if($request->notificationDisabled){
                $send_object['notification_disabled']    =  $request->notificationDisabled == "notificationDisabled" ? true : false;
            }

            if($request->customAggregationUnits){
                $customAggregationUnits =   $request->customAggregationUnits[0];
                if($customAggregationUnits){
                    $send_object['custom_aggregation_units'] =  $customAggregationUnits;
                }else{
                    $send_object['custom_aggregation_units'] =  "autofill_" . (new DateTime())->format('YmdHis');
                }
            }

            $sends  =   array();
            if(isset($request->endpoint['type'])){
                switch($request->endpoint['type']){
                    case("push"):
                        foreach($request->endpoint["push"] as $user_id => $line_user_id){
                            $new_send_object        =   $send_object;
                            $new_send_object['to']  =   $line_user_id;
                            $send   =   new LineApiSend($new_send_object);
                            $send   =   $send->validate();
                            $send->save();
                            $sends[]    =   $send;
                        }
                        break;
                    case("broadcast"):
                        $send   =   new LineApiSend($send_object);
                        $send   =   $send->validate();
                        $send->save();
                        $sends[]    =   $send;
                        break;
                    default:
                        $send   =   new LineApiSend($send_object);
                        $send   =   $send->validate();
                        $send->save();
                }
            } else {
                $send   =   new LineApiSend($send_object);
                $send   =   $send->validate();
                $send->save();
            }

            foreach($sends as $send){
                if($send->status == "realtime"){
                    $send   =   $send->sending();
                }
                $send->save();
            }
        }

            public function generate_message_objects($messages, $channel_name)
            {
                $message_objects    =   array();
                foreach($messages as $message){
                    if(!is_null($message['type'])){
                        $message_object =   array();
                        switch($message['type']){
                            case "image":
                                if(!isset($message["previewImageUrl"])){
                                    $message["previewImageUrl"]  =  $message["originalContentUrl"];
                                }
                            case "text":
                            case "sticker":
                            case "video":
                            case "audio":
                            case "location":
                                foreach($message as $key => $value){
                                    $message_object[$key]   =   $value;
                                }
                                break;
                            case "template_buttons":
                            case "template_confirm":
                            case "template_carousel":
                            case "template_image_carousel":
                                list($type, $template_type)         =   explode("_", $message["type"], 2);
                                $message_object['type']             =   $type;
                                $message_object['altText']          =   $message["altText"];
                                $message_object['template']         =   array();
                                $message_object['template']['type'] =   $template_type;
                                if(isset($message["template"]["defaultAction"])){
                                    $message["template"]["defaultAction"]   =   $this->generate_action_object($message["template"]["defaultAction"]);
                                }
                                if(isset($message["template"]["actions"])){
                                    foreach($message["template"]["actions"] as $aciton_index => $action){
                                        $message["template"]["actions"][$aciton_index]    =   $this->generate_action_object($action);
                                    }
                                    $message["template"]["actions"] =   array_values($message["template"]["actions"]);
                                }
                                if(isset($message["template"]["columns"])){
                                    foreach($message["template"]["columns"] as $column_index => $column){
                                        if(isset($column["defaultAction"])){
                                            $message["template"]["columns"][$column_index]["defaultAction"]   =   $this->generate_action_object($column["defaultAction"]);
                                        }
                                        if(isset($column["actions"])){
                                            foreach($column["actions"] as $column_aciton_index => $column_action){
                                                $message["template"]["columns"][$column_index]["actions"][$column_aciton_index]    =   $this->generate_action_object($column_action);
                                            }
                                            $message["template"]["columns"][$column_index]["actions"] =   array_values($message["template"]["columns"][$column_index]["actions"]);
                                        }
                                        if(isset($column["action"])){
                                            $message["template"]["columns"][$column_index]["action"]   =   $this->generate_action_object($column["action"]);
                                        }
                                    }
                                    $message["template"]["columns"] =   array_values($message["template"]["columns"]);
                                }
                                foreach($message['template'] as $key => $value){
                                    if($value){
                                        $message_object['template'][$key]   =   $value;
                                    }
                                }
                                break;
                            case "imagemap":
                            case "flex":
                        }

                        // LINE API MESSAGE を作成する
                        $line_api_message   =   new LineApiMessage();
                        foreach($message_object as $key => $value) {
                            $converted_key  =   strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $key));  
                            $line_api_message[$converted_key]   =   $value;
                        }
                        $line_api_message->channel_name =   $channel_name;
                        $line_api_message->category     =   "draft";
                        $line_api_message->name         =   "autofill_" . (new DateTime())->format('YmdHis');
                        $line_api_message->save();
                        $message_objects[]  =   $line_api_message->id;
                    }
                }
                return $message_objects;
            }
            public function generate_action_object($action)
            {
                switch($action["type"]){
                    case "datetimepicker_date":
                    case "datetimepicker_time":
                    case "datetimepicker_datetime":
                        list($type, $mode)  =   explode("_", $action['type'], 2);
                        $action['type'] =   $type;
                        $action['mode'] =   $mode;
                    case "postback":
                        $data   =   array();
                        if(is_array($action["data"])){
                            foreach($action["data"] as $key => $value){
                                $data[] =   "$key=$value";
                            }
                            $action["data"] =   implode("&",$data);
                        } else {
                            $action["data"] =   $action["data"];
                        }
                        break;
                    }
                return $action;
            }

            public function get_message_url($endpoint_type)
            {   
                $message_urls  =   array(
                    "reply"         =>  "https://api.line.me/v2/bot/message/reply",
                    "push"          =>  "https://api.line.me/v2/bot/message/push",
                    "multicast"     =>  "https://api.line.me/v2/bot/message/multicast",
                    "narrowcast"    =>  "https://api.line.me/v2/bot/message/narrowcast",
                    "broadcast"     =>  "https://api.line.me/v2/bot/message/broadcast",
                );
                return isset($message_urls[$endpoint_type]) ? $message_urls[$endpoint_type] : null;
            }
    
            public function get_validate_url($endpoint_type)
            {
                $validate_urls  =   array(
                    "reply"         =>  "https://api.line.me/v2/bot/message/validate/reply",
                    "push"          =>  "https://api.line.me/v2/bot/message/validate/push",
                    "multicast"     =>  "https://api.line.me/v2/bot/message/validate/multicast",
                    "narrowcast"    =>  "https://api.line.me/v2/bot/message/validate/narrowcast",
                    "broadcast"     =>  "https://api.line.me/v2/bot/message/validate/broadcast",
                );
                return isset($validate_urls[$endpoint_type]) ? $validate_urls[$endpoint_type] : $validate_urls["push"];
            }
    
            
        // 御でぃえんす
        // https://developers.line.biz/ja/reference/messaging-api/#create-click-audience-group

    /** statistic */
        public function get_quota($channel_name)
        {
            if(LineApiChannel::whereChannelName($channel_name)->exists()){
                $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
                $headers = array(
                    'Authorization'     =>  'Bearer ' . $channel->access_token,
                );
                $quota = Http::withHeaders($headers)->get("https://api.line.me/v2/bot/message/quota");
                if($quota->successful()){
                    return $quota->json();
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }

        public function get_quota_consumption($channel_name)
        {
            if(LineApiChannel::whereChannelName($channel_name)->exists()){
                $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
                $headers = array(
                    'Authorization'     =>  'Bearer ' . $channel->access_token,
                );
                $quota_consumption =   Http::withHeaders($headers)->get("https://api.line.me/v2/bot/message/quota/consumption");
                if($quota_consumption->successful()){
                    return $quota_consumption->json();
                }else{
                    return null;
                }
            }else{
                return null;
            }

        }

    

        public function get_statistics($request, $channel_name)
        {
            if(LineApiChannel::whereChannelName($channel_name)->exists()){
                $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
                $headers = array(
                    'Authorization'     =>  'Bearer ' . $channel->access_token,
                );
                $endpoint   =   "https://api.line.me/v2/bot/insight/message/event";
                if(isset($request->request_id)){
                    $query      =   array(
                        "requestId" =>   $request['request_id'],
                    );
                }
                // if(isset($request->custom_aggregation_unit)){
                    $endpoint   .=  "/aggregation";
                    if(isset($request['from']) && isset($request['to'])){
                        $request["from"]    =   date("Ymd",$request["from"]);
                        $request["to"]      =   date("Ymd",$request["to"]);
                    }elseif(isset($request['from']) && !isset($request['to'])){
                        $request["from"]    =   date("Ymd",$request["from"]);
                        $request["to"]      =   date("Ymd",strtotime($request["from"] . "+30 days"));
                    }elseif(!isset($request['from']) && isset($request['to'])){
                        $request["to"]      =   date("Ymd",$request["to"]);
                        $request["from"]    =   date("Ymd",strtotime($request["to"] . "-30 days"));
                    }elseif(!isset($request['from']) && !isset($request['to'])){
                        $request["from"]    =   date("Ymd",strtotime("-30 days"));
                        $request["to"]      =   date("Ymd");
                    }
                    $query  =   array(
                        "customAggregationUnit" =>  "jinguji", //$request['custom_aggregation_unit'],
                        "from"  =>  $request['from'],
                        "to"    =>  $request['to'],
                    );
                // }
                if(isset($query)){
                    $endpoint   .=  "?" . http_build_query($query);
                }
                $statistics =   Http::withHeaders($headers)->get($endpoint);
                if($statistics->successful()){
                    return $statistics->json();
                }else{
                    return null;
                }
            }else{
                return null;
            }
            return null;
        }
    /** richmenu */
}