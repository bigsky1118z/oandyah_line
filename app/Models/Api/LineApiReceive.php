<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\Environment\Runtime;

use function PHPUnit\Framework\returnSelf;

class LineApiReceive extends Model
{
    use HasFactory;
    protected $fillable = [
        "ip_address",
        "request_host",
        "request_path",
        "channel_name",
        "request_method",
        "x_line_signature",
        "destination",
        "query_string",

        'type',
        'mode',
        'webhook_event_id',
        'reply_token',
        'line_user_id',
        'line_group_id',
        'is_redelivery',
        'event',
    ];

    protected $casts = [
        'event'  => 'json',
    ];

    /** リレーション */
    public function user()
    {
        return $this->hasOne(LineApiUser::class, "line_user_id", "line_user_id")->where("channel_name", $this->channel_name);
    }
    
    public function line_api_user()
    {
        return $this->hasOne(LineApiUser::class, "line_user_id", "line_user_id")->where("channel_name", $this->channel_name);
    }

    public function channel()
    {
        return $this->hasOne(LineApiChannel::class, "channel_name", "channel_name");
    }

    /** GET {channel_name}/receive/message */
        public function get_sticker()
        {
            $sticker    =   "Sticker";
            if(isset($this->event['keywords'])){
                $sticker    .=  " keyword:" . implode(",",$this->event['keywords']);
            }
            if(isset($this->event['text'])){
                $sticker    .=  " text:" . $this->event['text'];
            }
            return $sticker;
        }
        public function get_content($width, $height, $alt = null)
        {
            $headers = array(
                'Authorization'     =>  'Bearer ' . $this->channel->access_token,
            );
            $response   =   Http::withHeaders($headers)->get("https://api-data.line.me/v2/bot/message/$this->event['id']/content");
            if($response->successful()){
                switch($response->header("Content-Type")){
                    case "image/jpeg":
                        $content    =   '<img src="data:'. $response->header("Content-Type") . ';base64,' . base64_encode($response->body()) . '" width="'. $width .'" height="'. $height .'" alt="'. $alt .'" />';
                        break;
                    default:
                        $content    =   $response->header("Content-Type");
                }
            }else{
                $content  =   null;
            }
            return $content;
        }
    /** GET {channel_name}/receive/message */
        public function get_data($key = null)
        {
            if(isset($this->postback)){
                parse_str($this->postback, $data);
                if(!$key){
                    $data   =   $data;
                }else if($key && isset($data[$key])){
                    $data   =   $data[$key];
                }else{
                    $data   =   null;
                }
            }
            return isset($data) ? $data : null;
        }

    public function get_reply()
    {
        $reply  =   LineApiReply::query();
        $reply->whereChannelName($this->channel_name);
        $reply->whereType($this->type);
        $reply->whereActive(true);
        $reply->latest("id");
        $condition  =   clone $reply;
        switch($this->type){
            case("follow"):
                if($this->line_api_user()->exists()){
                    $condition->where("condition","refollow");
                } else {
                    $condition->where("condition","follow");
                }
                break;
            case('message'):

                break;
            case('postback'):
                if(isset($this->postback)){
                    // return LineApiReply::find(2);
                    parse_str($this->postback, $data);
                    foreach($data as $key => $value){
                        $condition->where(fn($query)=>$query->where("condition","like","%$key=$value%")->orWhere("condition","like","%$key=any%"));

                        // $condition->where( function($query) use ($key, $value) {
                        //     $query->where("condition","like","%$key=$value%")->orWhere("condition","like","%$key=any%");
                        // });
                    }
                } else {
                    $condition->whereNull("id");
                }
                break;
        }
        if($condition->exists()){
            $date   =   date("Y-m-d H:i:s");
            $v_e_reply  =   (clone $condition)->where("valid_at","<=",$date)->where("expired_at",">",$date);
            $e_reply    =   (clone $condition)->whereNull("valid_at")->where("expired_at",">",$date);
            $v_reply    =   (clone $condition)->where("valid_at","<=",$date)->whereNull("expired_at");
            $n_reply    =   (clone $condition)->whereNull("valid_at")->whereNull("expired_at");
            if($v_e_reply->exists()){
                return  $v_e_reply->first();
            }elseif($e_reply->exists()){
                return  $e_reply->first();
            }elseif($v_reply->exists()){
                return  $v_reply->first();
            }elseif($n_reply->exists()){
                return  $n_reply->first();
            }
        }

        $default    =   (clone $reply)->whereCondition("default");
        if($default->exists()) {
            return $default->first();
        } else {
            return null;
        }
    }

    public function reactions()
    {
        return $this->hasMany(LineApiReaction::class);
    }

    public function get_order_menu()
    {
        $id =   null;
        if(isset($this->postback) && strpos($this->postback,"action=order") !== false){
            parse_str($this->postback, $data);
            if(isset($data["detail"])){
                $id =   (int) $data["detail"];
            }
        }
        return LineApiOrderMenu::where("id",$id)->where("channel_name",$this->channel_name)->first();
    }
}
