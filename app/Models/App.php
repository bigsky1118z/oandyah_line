<?php

namespace App\Models;

use App\Library\MessagingApi;
use App\Models\App\AppFriend;
use App\Models\App\AppReply;
use App\Models\App\AppReplyCondition;
use App\Models\App\AppSend;
use App\Models\App\AppWebhook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class App extends Model
{
    use HasFactory;

    protected $fillable =   [
        "client_id",
        "channel_access_token",
        "channel_secret",

        "user_id",
        "basic_id",
        "display_name",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",

        "status",
    ];

    /** relation */
        public function users()
        {
            return $this->hasMany(UserApp::class,"app_id", "id");
        }

        public function webhooks()
        {
            return $this->hasMany(AppWebhook::class,"app_id", "id");
        }


        public function friends()
        {
            return $this->hasMany(AppFriend::class);
        }

        public function friend($friend_id)
        {
            return $this->hasOne(AppFriend::class)->whereFriendId($friend_id)->first();
        }

        public function replies()
        {
            return $this->hasMany(AppReply::class);
        }
        public function reply($id)
        {
            return $this->hasOne(AppReply::class)->whereId($id)->first() ?? new AppReply();
        }


        public function reply_conditions()
        {
            return $this->hasMany(AppReplyCondition::class);
        }
        public function reply_condition_defaults()
        {
            return $this->hasMany(AppReplyCondition::class)->whereEnable(true)->whereDefault(true)->orderBy("priority");
        }
        


        public function sends()
        {
            return $this->hasMany(AppSend::class);
        }
    /** function */
        public function get_channel_access_token($option = null){
            $channel_access_token       =   $this->channel_access_token;
            if($option == "hidden"){
                $pattern                =   "/a|B|c|D|e|F|g|H|i|J|k|L|m|N|o|P|q|R|s|T|u|V|w|X|y|Z/";
                $channel_access_token   =   preg_replace($pattern,"*",$channel_access_token);
            }
            return $channel_access_token;
        }
        
        static $chat_modes  =   array(
            "chat"  =>  "オン",
            "bot"   =>  "オフ",
        );
        public function get_chat_mode()
        {
            return self::$chat_modes[$this->chat_mode] ?? $this->chat_mode;
        }
        static $mark_as_read_modes  =   array(
            "auto"      =>  "有効",
            "manual"    =>  "無効",
        );
        public function get_mark_as_read_mode()
        {
            return self::$mark_as_read_modes[$this->mark_as_read_mode] ?? $this->mark_as_read_mode;
        }

    /** App */
        static function create_app($channel_access_token, $channel_secret)
        {
            $response   =   MessagingApi::verify_channel_access_token($channel_access_token);
            $client_id  =   $response->json("client_id");
            if($response->successful() && $client_id){
                $app    =   App::updateOrCreate(array(
                    "client_id"             =>  $client_id,
                ),array(
                    "channel_access_token"  =>  $channel_access_token,
                    "channel_secret"        =>  $channel_secret,
                    "status"                =>  "active",
                ));
                return $app->latest();
            } else {
                return new App();
            }
        }

        public function latest()
        {
            $this->put_webhook_endpoint();
            $info                       =   $this->get_info();
            $this->user_id              =   $info["userId"]         ?? $this->user_id;
            $this->basic_id             =   $info["basicId"]        ?? $this->basic_id;
            $this->display_name         =   $info["displayName"]    ?? $this->display_name;
            $this->picture_url          =   $info["pictureUrl"]     ?? $this->picture_url;
            $this->chat_mode            =   $info["chatMode"]       ?? $this->chat_mode;
            $this->mark_as_read_mode    =   $info["markAsReadMode"] ?? $this->mark_as_read_mode;
            $this->save();
            return $this;
        }

    /** webhook_endpoint */
        public function get_webhook_endpoint()
        {
            $response   =   MessagingApi::get_webhook_endpoint($this->channel_access_token);
            return $response;
        }

        public function put_webhook_endpoint()
        {
            $response   =   MessagingApi::put_webhook_endpoint($this->client_id, $this->channel_access_token);
            return $response;
        }

        public function get_info()
        {
            $response   =   MessagingApi::get_info($this->channel_access_token);
            return $response;
        }

    /* channel access token */
        public function verify_channel_access_token()
        {
            $response   =   MessagingApi::verify_channel_access_token($this->channel_access_token);
            return $response;
        }




    /* bot */ 

        public function get_insight_message_delivery($date = null)
        {
            $date       =   $date ?? date("Ymd",  mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
            );
            $data       =   array(
                "date"  =>  $date,
            );
            $url        =   "https://api.line.me/v2/bot/insight/message/delivery";
            $response   =   Http::asForm()->withHeaders($headers)->get($url, $data);
            return $response;
        }

        public function get_insight_followers($date = null)
        {
            $date       =   $date ?? date("Ymd",  mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
            );
            $data       =   array(
                "date"  =>  $date,
            );
            $url        =   "https://api.line.me/v2/bot/insight/followers?date=$date";
            $response   =   Http::asForm()->withHeaders($headers)->get($url, $data);
            return $response;
        }

        public function get_insight_demographic()
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
            );
            $url        =   "https://api.line.me/v2/bot/insight/demographic";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }



        /** message に移動する可能性あり */
        public function get_insight_message_event($request_id)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
            );
            $data       =   array(
                "requestId"  =>  $request_id,
            );
            $url        =   "https://api.line.me/v2/bot/insight/message/event";
            $response   =   Http::asForm()->withHeaders($headers)->get($url, $data);
            return $response;
        }

        public function get_insight_message_event_aggregation($request_id = null)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
            );
            $data       =   array(
                "customAggregationUnit" =>  $request_id,
                "from"                  =>  date("Ymd",  mktime(0, 0, 0, date("m"), date("d")-1, date("Y"))),
                "to"                    =>  date("Ymd",  mktime(0, 0, 0, date("m"), date("d")-1, date("Y"))),
            );
            $url        =   "https://api.line.me/v2/bot/insight/message/event/aggregation";
            $response   =   Http::asForm()->withHeaders($headers)->get($url, $data);
            return $response;
        }

        public function get_insight_message_event_aggregation_info()
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
            );
            $url        =   "https://api.line.me/v2/bot/message/aggregation/info";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }

        public function get_insight_message_event_aggregation_list($limit = 100, $start = null)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
            );
            $data       =   array(
                "limit" =>  $limit,
            );
            $start      ?   $data["start"]  =   $start  : null;
            
            $url        =   "https://api.line.me/v2/bot/message/aggregation/list";
            $response   =   Http::asForm()->withHeaders($headers)->get($url, $data);
            return $response;
        }


    // 

        

        
    
    

}