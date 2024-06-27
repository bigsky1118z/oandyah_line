<?php

namespace App\Models;

use App\Library\CsvFile;
use App\Library\MessagingApi;
use App\Models\App\AppFriend;
use App\Models\App\AppMessage;
use App\Models\App\AppReply;
use App\Models\App\AppReplyCondition;
use App\Models\App\AppRichmenu;
use App\Models\App\AppWebhook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class App extends Model
{
    use HasFactory;

    protected $fillable =   [
        "id",

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
        public function webhook($id)
        {
            return $this->hasOne(AppWebhook::class)->where("id",$id)->first();
        }

        public function friends()
        {
            return $this->hasMany(AppFriend::class);
        }

        public function friend($friend_id)
        {
            return $this->hasOne(AppFriend::class)->where("friend_id",$friend_id)->first();
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
        


        public function messages()
        {
            return $this->hasMany(AppMessage::class);
        }
        public function message($app_message_id)
        {
            return $this->hasOne(AppMessage::class)->whereId($app_message_id)->first() ?? new AppMessage();
        }

        public function richmenus()
        {
            return $this->hasMany(AppRichmenu::class);
        }
        public function richmenu($app_richmenu_id)
        {
            return $this->hasOne(AppRichmenu::class)->where("id",$app_richmenu_id)->first();
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
    /** backup */
    static function get_data()
    {
        $table_name =   (new self)->getTable();
        $columns    =   CsvFile::get_columns($table_name);
        $add        =   array();
        $headers    =   array_merge($columns, $add);
        $all        =   self::all();
        $data       =   array();
        $data[]     =   $headers;
        foreach($all as $one){
            $data[] =   array_map(function($header) use ($one){
                $value  =   "";
                switch($header){
                    default:
                        $value  =   $one[$header];
                }
                return $value;
            },$headers);
        }
        return $data;
    }

    static function backup()
    {
        $table_name =   (new self)->getTable();
        $data       =   self::get_data();
        $storage    =   CsvFile::backup($data,$table_name);
        return $table_name;
    }

    static function download()
    {
        $table_name =   (new self)->getTable();
        $data       =   self::get_data();
        $download   =   CsvFile::download($data, $table_name);
        return $download;
    }

    static function seed()
    {

    }

    static function restoration($data)
    {
        foreach($data as $datum){
            if(self::where("client_id",($datum["client_id"] ?? null))->exists()){
                continue;
            }
            if(self::where("channel_access_token",($datum["channel_access_token"] ?? null))->exists()){
                continue;
            }
            $app    =   App::updateOrCreate(array(
                "id"                    =>  $datum["id"]                    ?? null,
            ),array(
                "client_id"             =>  $datum["client_id"]             ?? null,
                "channel_access_token"  =>  $datum["channel_access_token"]  ?? null,
                "channel_secret"        =>  $datum["channel_secret"]        ?? null,
                "user_id"               =>  $datum["user_id"]               ?? null,
                "basic_id"              =>  $datum["basic_id"]              ?? null,
                "display_name"          =>  $datum["display_name"]          ?? null,
                "picture_url"           =>  $datum["picture_url"]           ?? null,
                "chat_mode"             =>  $datum["chat_mode"]             ?? null,
                "mark_as_read_mode"     =>  $datum["mark_as_read_mode"]     ?? null,
                "status"                =>  $datum["status"]                ?? null,
                "created_at"            =>  $datum["created_at"]            ?? null,
                "updated_at"            =>  $datum["updated_at"]            ?? null,
            ));
        }
    }

}