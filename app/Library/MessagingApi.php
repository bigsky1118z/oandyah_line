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
        static function get_profile($channel_access_token, $friend_id)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer " . $channel_access_token,
                "Content-Type"  =>  "application/json",
            );
            $url    =   "https://api.line.me/v2/bot/profile/$friend_id";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response; 
        }
    /** message */
        /** validate message */
            static function velidate_message_reply($channel_access_token, $data){
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/message/validate/reply";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
            }
            static function velidate_message_push($channel_access_token, $data){
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/message/validate/push";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
            }
            static function velidate_message_multicast($channel_access_token, $data){
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/message/validate/multicast";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
            }
            static function velidate_message_narrowcast($channel_access_token, $data){
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/message/validate/narrowcast";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
            }
            static function velidate_message_broadcast($channel_access_token, $data){
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/message/validate/broadcast";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
            }
        /** send message */
            static function post_message_reply($channel_access_token, $data)
            {
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/message/reply";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
            }

            static function post_message_push($channel_access_token, $data)
            {
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/message/push";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
            }

            static function post_loading_start($channel_access_token, $friend_id, $seconds = 5)
            {
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $data       =   array(
                    "chatId"            =>  $friend_id,
                    "loadingSeconds"    =>  $seconds,
                );
                $url        =   "https://api.line.me/v2/bot/chat/loading/start";
                $response   =   Http::withHeaders($headers)->post($url, $data);
                return $response;
                // POST https://api.line.me/v2/bot/chat/loading/start
                // https://developers.line.biz/ja/reference/messaging-api/#display-a-loading-indicator
            }


    /** richmenu */
        static function get_richmenus($channel_access_token)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
            );
            $url        =   "https://api.line.me/v2/bot/richmenu/list";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }

        static function get_richmenu($channel_access_token, $richmenu_id)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
            );
            $url        =   "https://api.line.me/v2/bot/richmenu/$richmenu_id";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }
        static function get_richmenu_content($channel_access_token, $richmenu_id)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
            );
            $url        =   "https://api-data.line.me/v2/bot/richmenu/$richmenu_id/content";
            $response   =   Http::withHeaders($headers)->get($url);
            return $response;
        }

        static function validate_richmemu($channel_access_token, $data)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
                "Content-Type"  =>  "application/json",
            );
            $url        =   "https://api.line.me/v2/bot/richmenu/validate";
            $response   =   Http::withHeaders($headers)->post($url, $data);
            return $response;
        }

        static function post_richmemu($channel_access_token, $data)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
                "Content-Type"  =>  "application/json",
            );
            $url        =   "https://api.line.me/v2/bot/richmenu";
            $response   =   Http::withHeaders($headers)->post($url, $data);
            return $response;
        }

        static function post_richmenu_content($channel_access_token, $richmenu_id, $richmenu_content_file, $richmenu_content_mimetype)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
            );
            $url        =   "https://api-data.line.me/v2/bot/richmenu/$richmenu_id/content";
            $response   =   Http::withHeaders($headers)->withBody($richmenu_content_file, $richmenu_content_mimetype)->post($url);
            return $response;
        }

        static function delete_richmemu($channel_access_token, $richmenu_id)
        {
            $headers    =   array(
                "Authorization" =>  "Bearer $channel_access_token",
                "Content-Type"  =>  "application/json",
            );
            $url        =   "https://api.line.me/v2/bot/richmenu/$richmenu_id";
            $response   =   Http::withHeaders($headers)->delete($url);
            return $response;
        }
        /** default menu */
            static function get_richmemu_default($channel_access_token)
            {
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/user/all/richmenu";
                $response   =   Http::withHeaders($headers)->get($url);
                return $response;
            }
            static function post_richmemu_default($channel_access_token, $richmenu_id)
            {
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/user/all/richmenu/$richmenu_id";
                $response   =   Http::withHeaders($headers)->post($url);
                return $response;
            }
            static function delete_richmemu_default($channel_access_token)
            {
                $headers    =   array(
                    "Authorization" =>  "Bearer $channel_access_token",
                    "Content-Type"  =>  "application/json",
                );
                $url        =   "https://api.line.me/v2/bot/user/all/richmenu";
                $response   =   Http::withHeaders($headers)->delete($url);
                return $response;
            }
            

}