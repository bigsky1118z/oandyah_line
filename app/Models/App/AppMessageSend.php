<?php

namespace App\Models\App;

use App\Library\MessagingApi;
use App\Models\App\AppMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMessageSend extends Model
{
    use HasFactory;
    protected $fillable =   [
        "id",

        "app_message_id",
        "data",
        "friend_id",

        "x_line_retry_key",

        "response_code",
        "x_line_request_id",
        "sent_messages",
        "error_message",
        "error_details",
        "datetime",
    ];

    protected $casts    =   [
        "data"          =>  "json",
        "sent_messages" =>  "json",
        "error_details" =>  "json",
        "datetime"      =>  "datetime",
    ];

    /** relation */
    public function message()
    {
        return $this->belongsTo(AppMessage::class,"app_message_id","id");
    }

    public function sending(){
        $message                =   $this->message;
        $app                    =   $message->app;
        $channel_access_token   =   $app->channel_access_token;
        $data                   =   $this->data;
        $response               =   null;
        switch($message->type){
            case("reply"):
                $response   =   MessagingApi::post_message_reply($channel_access_token, $data);
                break;
            case("push"):
                $response   =   MessagingApi::post_message_push($channel_access_token, $data);
                break;
        }
        if($response){
            $this->response_code        =   $response->status();
            $this->datetime             =   $response->header("date");
            $this->x_line_request_id    =   $response->header("x-line-request-id");
            if($response->successful()){
                $this->sent_messages    =   $response->json("sentMessages");
            } else {
                $this->error_message    =   $response->json("message");
                $this->error_details    =   $response->json("details");
            }
        }
        $this->save();
        return $this;
    }

    public function get_friend()
    {
        $message    =   $this->message;
        $app        =   $message->app;
        $friend     =   AppFriend::where("app_id", $app->id)->where("friend_id", $this->friend_id)->first() ?? new AppFriend();
        return $friend->latest();
    }
}