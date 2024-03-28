<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $fillable =   [
        "user_id",
        "app_name",
        "channel_access_token",
        "line_user_id",
        "basic_id",
        "display_name",
        "picture_url",
        "chat_mode",
        "mark_as_read_mode",
    ];

    public function get_app($user,$app_name)
    {
        return App::whereUserId($user->id)->whereAppName($app_name)->first();
    }
}