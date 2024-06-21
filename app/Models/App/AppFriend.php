<?php

namespace App\Models\App;

use App\Library\MessagingApi;
use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppFriend extends Model
{
    use HasFactory;
    protected $fillable = [
        "app_id",
        "friend_id",
        "status",
        "display_name",
        "language",
        "picture_url",
        "status_message",
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }


    public function get_name()
    {
        $name   =   "";
        $name   =   $name == "" ? $this->display_name   : $name;
        $name   =   $name == "" ? $this->friend_id      : $name;
        return $name;
    }

    public function latest()
    {
        $app        =   $this->app;
        $response   =   MessagingApi::get_profile($this->friend_id, $app->channel_access_token);
        if($response->successful()){
            $this->status           =   "follow";
            $this->display_name     =   $response["displayName"]    ??  $this->display_name;
            $this->language         =   $response["language"]       ??  $this->language;
            $this->picture_url      =   $response["pictureUrl"]     ??  $this->picture_url;
            $this->status_message   =   $response["statusMessage"]  ??  $this->status_message;
        } else {
            $this->status           =   "unfollow";
        }
        $this->save();
        return $this;
    }
}
