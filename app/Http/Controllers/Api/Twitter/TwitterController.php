<?php

namespace App\Http\Controllers\Api\Twitter;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function redirect()
    {
        return Socialite::driver("twitter")->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $twitter    =   Socialite::driver("twitter")->user();
        } catch (Exception $error) {
            return redirect("/api/twitter/auth/redirect");
        }
        
        $token          =   $twitter->token;
        $token_secret   =   $twitter->tokenSecret;

        $data   =   array(
            "twitter"  =>  $twitter,
        );
        // $url            =   "https://api.twitter.com/2/tweets";
        // $headers        =   array(
        // );
        // $body           =   array(
        // );
        // Http::withHeaders($headers)->withBody($body, "application/json")->post($url);

        return view("api.twitter.callback", $data);
    }

}

/*
{
    "id":"1509284782852931585",
    "nickname":"jweb_announce",
    "name":"jweb\u66f4\u65b0\u901a\u77e5",
    "email":null,
    "avatar":"http:\/\/pbs.twimg.com\/profile_images\/1509709794466471937\/dcv5Pmaf_normal.jpg",
    "user":{
        "id_str":"1509284782852931585",
        "entities":{
            "description":{
                "urls":[]
            }
        },
    "protected":false,
    "followers_count":770,
    "friends_count":112,
    "listed_count":2,
    "created_at":"Wed Mar 30 21:41:59 +0000 2022",
    "favourites_count":79,
    "utc_offset":null,
    "time_zone":null,
    "geo_enabled":false,
    "verified":false,
    "statuses_count":31961,
    "lang":null,
    "status":{
        "created_at":"Thu Aug 31 14:00:09 +0000 2023",
        "id":1697247908947759144,
        "id_str":"1697247908947759144",
        "text":"\u4e2d\u5cf6\u5065\u4eba\u3055\u3093\u304cKen Tea Time\u3092\u66f4\u65b0\u3057\u307e\u3057\u305f\uff01\n[2023\/08\/31 23:00\u66f4\u65b0]\n\n#\u4e2d\u5cf6\u5065\u4eba #KenTeaTime #SexyZone\nhttps:\/\/t.co\/yS2U1wOxvw",
        "truncated":false,
        "entities":{
            "hashtags":[
                {
                    "text":"\u4e2d\u5cf6\u5065\u4eba",
                    "indices":[50,55]
                },
                {
                    "text":"KenTeaTime",
                    "indices":[56,67]
                },
                {
                    "text":"SexyZone",
                    "indices":[68,77]
                }
            ],
            "symbols":[],
            "user_mentions":[],
            "urls":[
                {
                    "url":"https:\/\/t.co\/yS2U1wOxvw",
                    "expanded_url":"https:\/\/bit.ly\/3Lo0ScI",
                    "display_url":"bit.ly\/3Lo0ScI",
                    "indices":[78,101]
                }
            ]
        },
        "source":"jweb_announce<\/a>",
        "in_reply_to_status_id":null,
        "in_reply_to_status_id_str":null,
        "in_reply_to_user_id":null,
        "in_reply_to_user_id_str":null,
        "in_reply_to_screen_name":null,
        "geo":null,
        "coordinates":null,
        "place":null,
        "contributors":null,
        "is_quote_status":false,
        "retweet_count":0,
        "favorite_count":0,
        "favorited":false,
        "retweeted":false,
        "possibly_sensitive":false,
        "lang":"ja"
    },
    "contributors_enabled":false,
    "is_translator":false,
    "is_translation_enabled":false,
    "profile_background_color":"F5F8FA",
    "profile_background_tile":false,
    "profile_link_color":"1DA1F2",
    "profile_sidebar_border_color":"C0DEED",
    "profile_sidebar_fill_color":"DDEEF6",
    "profile_text_color":"333333",
    "profile_use_background_image":true,
    "has_extended_profile":true,
    "default_profile":true,
    "default_profile_image":false,
    "following":false,
    "follow_request_sent":false,
    "notifications":false,
    "translator_type":"none",
    "withheld_in_countries":[],
    "suspended":false,
    "needs_phone_verification":false,
    "url":null,
    "profile_background_image_url":null,
    "profile_background_image_url_https":null,
    "profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/1509709794466471937\/dcv5Pmaf_normal.jpg",
    "profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/1509709794466471937\/dcv5Pmaf_normal.jpg",
    "profile_banner_url":"https:\/\/pbs.twimg.com\/profile_banners\/1509284782852931585\/1648778055",
    "location":"\u65e5\u672c",
    "description":"Johnny's web\u306e\u66f4\u65b0\u3092Twitter\u306b\u6295\u7a3f\u3057\u3066\u304a\u77e5\u3089\u305b\u3057\u307e\u3059\uff01\u203b\u516c\u5f0f\u30a2\u30ab\u30a6\u30f3\u30c8\u3067\u306f\u3042\u308a\u307e\u305b\u3093\u3002\u60c5\u5831\u306b\u6f0f\u308c\u3084\u8aa4\u308a\u304c\u3042\u308b\u3053\u3068\u304c\u3042\u308a\u307e\u3059\u3002"},
    "attributes":{
        "id":"1509284782852931585",
        "nickname":"jweb_announce",
        "name":"jweb\u66f4\u65b0\u901a\u77e5",
        "email":null,
        "avatar":"http:\/\/pbs.twimg.com\/profile_images\/1509709794466471937\/dcv5Pmaf_normal.jpg",
        "avatar_original":"http:\/\/pbs.twimg.com\/profile_images\/1509709794466471937\/dcv5Pmaf.jpg"
    },
    "token":"1509284782852931585-ouXcTQcpZPGDMNgGBI2XvsOjYFxbDP",
    "tokenSecret":"hr8l2N19VhQuyD0L7xyHC2ESy3HMfuS8FQwVunhYVUxYx"
}
*/