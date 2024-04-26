<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppRichmenu extends Model
{
    use HasFactory;


    static function get_richmenus($channel_access_token)
    {
        $headers    =   array(
            "Authorization" =>  "Bearer $channel_access_token",
        );
        $url        =   "https://api.line.me/v2/bot/richmenu/list";
        $response   =   Http::withHeaders($headers)->get($url);
        return $response;
    }

}
