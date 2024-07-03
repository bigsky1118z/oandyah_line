<?php

namespace App\Models\App;

use App\Library\MessagingApi;
use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppReplyMessage extends Model
{
    use HasFactory;
    protected $fillable =   [
        "id",
        "app_reply_id",
        "name",
        "messages",
        "status",
        "error_message",
        "error_details",
    ];
    protected $casts    =   [
        "messages"          =>  "json",
        "error_details"     =>  "json",
    ];

    public function reply()
    {
        return $this->belongsTo(AppReply::class,"app_reply_id","id");
    }

    public function latest()
    {
        $validation     =   $this->validate_message();
        if($validation->successful()){
            $this->status   =   $this->status == "private" ? $this->status : "active";
        } else {
            $this->status           =   "draft";
            $this->error_message    =   $validation->json("message") ?? null;
            $this->error_details    =   $validation->json("details") ?? array();
        }
        $this->save();
        return $this;
    }

    public function validate_message()
    {
        $reply                  =   $this->reply                ??  new AppReply();
        $app                    =   $reply->app                 ??  new App();
        $channel_access_token   =   $app->channel_access_token  ??  null;
        $data                   =   array(
            "messages"  =>  $this->messages,
        );
        $response   =   MessagingApi::velidate_message_reply($channel_access_token, $data);
        return $response;
    }





    
    
}
