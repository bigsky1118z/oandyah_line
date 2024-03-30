<?php

namespace App\Models;

use App\Models\App\AppFriend;
use App\Models\App\AppWebhook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class App extends Model
{
    use HasFactory;

    protected $fillable =   [
        "name",
        "channel_access_token",
        "user_id",
        "basic_id",
        "display_name",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",
    ];

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

    public function friend($frined_id)
    {

        $friend =   $frined_id ? AppFriend::updateOrCreate(array(
            "app_id"    =>  $this->id,
            "friend_id" =>  $frined_id,
        )) : null;
        return $friend;
    }


    public function latest()
    {
        $channel_access_token       =   $this->channel_access_token;
        $info                       =   $this->get_bot_info($channel_access_token);
        $this->user_id              =   $info["userId"]         ?? $this->user_id;
        $this->basic_id             =   $info["basicId"]        ?? $this->basic_id;
        $this->display_name         =   $info["displayName"]    ?? $this->display_name;
        $this->picture_url          =   $info["pictureUrl"]     ?? $this->picture_url;
        $this->chat_mode            =   $info["chatMode"]       ?? $this->chat_mode;
        $this->mark_as_read_mode    =   $info["markAsReadMode"] ?? $this->mark_as_read_mode;
        $this->save();
        return $this;
    }

    


    /* channel access token */


        static function post_oauth_verify_channel_access_token($channel_access_token)
        {
            $data       =   array(
                "access_token"  =>  $channel_access_token,
            );
            $url        =   "https://api.line.me/v2/oauth/verify";
            $response   =   Http::asForm()->post($url, $data);
            return $response;
        }

        static function put_bot_channel_webhook_endpoint($channel_access_token, $app_name)
        {
            $endpoint   =   "https://line.oandyah.com/app/$app_name";
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
                "Content-Type"  =>  "application/json",
            );
            $data       =   array(
                "endpoint"      =>  $endpoint,
            );
            $url        =   "https://api.line.me/v2/bot/channel/webhook/endpoint";
            $response   =   Http::withHeaders($headers)->put($url, $data);
            return $response;
        }

        public function get_bot_channel_webhook_endpoint()
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $this->channel_access_token",
                "Content-Type"  =>  "application/json",
            );
            $url        =   "https://api.line.me/v2/bot/channel/webhook/endpoint";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }



    /* bot */ 
        static function get_bot_info($channel_access_token)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
            );
            $url        =   "https://api.line.me/v2/bot/info";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }

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


    // friend

        
    
    

}