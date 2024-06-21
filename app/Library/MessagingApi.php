<?php

namespace App\Library;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MessagingApi extends Facade
{
    /** data */
        static function get_info($channel_access_token)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
            );
            $url        =   "https://api.line.me/v2/bot/info";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }

    /** channel_access_token */
        static function verify_channel_access_token($channel_access_token)
        {
            $data       =   array(
                "access_token"  =>  $channel_access_token,
            );
            $url        =   "https://api.line.me/v2/oauth/verify";
            $response   =   Http::asForm()->post($url, $data);
            return $response;
        }

    /** webhook_endpoint */
        static function get_webhook_endpoint($channel_access_token)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
                "Content-Type"  =>  "application/json",
            );
            $url        =   "https://api.line.me/v2/bot/channel/webhook/endpoint";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }
        static function put_webhook_endpoint($client_id, $channel_access_token)
        {
            $endpoint   =   "https://line.oandyah.com/app/$client_id";
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
    /** webhook */
        static function signature_validation($request_body, $channel_secret, $x_line_signature)
        {
            $hash               =   hash_hmac("sha256", $request_body, $channel_secret, true);
            $signature          =   base64_encode($hash);
            return $signature === $x_line_signature;
    
        }
    /** friend */
        static function get_profile($friend_id, $channel_access_token)
        {
            $url    =   "https://api.line.me/v2/bot/profile/$friend_id";
            $headers    =   array(
                "Authorization" =>  "Bearer " . $channel_access_token,
                "Content-Type"  =>  "application/json",
            );
            $response   =   Http::withHeaders($headers)->get($url);
            return $response; 
        }
    /** message */
    // static function post_message($type, $target, $messages, $channel_access_token)
    // {
    //     $headers    =   array(
    //         "Authorization" =>  "Bearer $channel_access_token",
    //         "Content-Type"  =>  "application/json",
    //     );
    //     switch($type){
    //         case("reply"):
    //             $data["replyToken"] =   $target;
    //             break;
    //         case("push"):
    //             $data["to"]         =   $target;
    //             break;
    //         }
    //     $data       =   array(
    //         "recipient"                 =>  $this->recipient                ??  null,
    //         "filter"                    =>  $this->filter                   ??  null,
    //         "limit"                     =>  $this->limit                    ??  null,
    //         "messages"                  =>  $messages                       ??  null,
    //         "customAggregationUnits"    =>  $this->custom_aggregation_units ?   array($this->custom_aggregation_units)  :   null,
    //         "notificationDisabled"      =>  $this->notification_disabled    ??  false,
    //     );
    //     $endpoint               =   "https://api.line.me/v2/bot/message/" . $this->type;
    //     $response               =   Http::withHeaders($headers)->post($endpoint, $data);
    //     $this->response_code    =   $response->status();
    //     if($response->successful()){
    //         $this->sent_messages    =   $response["sentMessages"] ?? null;
    //     } else {
    //         $this->error_message    =   $response["message"];
    //         $this->error_details    =   $response["details"];
    //     }
    //     $this->save();
        
    //     return $response;
    // }


}