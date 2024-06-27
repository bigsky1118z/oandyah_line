<?php

namespace App\Models\App;

use App\Library\MessagingApi;
use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;

class AppRichmenu extends Model
{
    use HasFactory;
    protected $fillable =   [
        "id",

        "app_id",
        
        "richmenu_id",
        "name",
        "chat_bar_text",
        "selected",
        "size",
        "areas",
        
        "status",
        "error_message",
        "error_details",
];
    protected $casts    =   [
        "selected"      =>  "boolean",
        "size"          =>  "json",
        "areas"         =>  "json",
        "error_details" =>  "json",
    ];

    static $types   =   array(
        "postback"          =>  "ポストバック",
        "message"           =>  "メッセージ",
        "uri"               =>  "URL",
        "datetimepicker"    =>  "日付選択",
        "richmenuswitch"    =>  "メニュー切り替え",
        "clipboard"         =>  "クリップボード",
    );



    public function app()
    {
        return $this->belongsTo(App::class);
    }

    
    public function latest()
    {
        $app    =   $this->app ?? new App();
        if($app->id){
            $richmenu_id    =   $this->richmenu_id;
            $status         =   $this->status;
            $errors         =   array();
            /** richmenu_id がある場合[uploaded || active || not_found] */
            if($richmenu_id){
                $richmenu   =   MessagingApi::get_richmenu($app->channel_access_token, $richmenu_id);
                if($richmenu->successful()){
                    $this->name             =   $richmenu->json("name")         ?? null;
                    $this->size             =   $richmenu->json("size")         ?? array();
                    $this->chat_bar_text    =   $richmenu->json("chatBarText")  ?? null;
                    $this->selected         =   $richmenu->json("selected")     ?? false;
                    $this->areas            =   $richmenu->json("areas")        ?? array();
                    $richmenu_content       =   $this->get_richmenu_content();
                    if($richmenu_content->successful()){
                        $status =   "active";
                        if($this->get_richmenu_content_exists()){
                        } else {
                            $this->create_richmenu_content($richmenu_content);
                        }
                    } else {
                        $status =   "draft";
                        $this->delete_richmenu();
                    }
                } else {
                    $status                 =   "not_found";
                    $errors["richmenu_id"]  =   $richmenu->json() ?? array();
                }
            /** richmenu_id がない場合[draft || standby] */
            } else {
                $validation                 =   $this->validate_richmenu();
                $richmenu_content_exists    =   $this->get_richmenu_content_exists();
                if($validation->successful() && $richmenu_content_exists){
                    $status =   "standby";
                } else {
                    $status =   "draft";
                    if(!$validation->successful()){
                        $errors["validation"]       =   $validation->json() ?? array();
                    }
                    if(!$richmenu_content_exists){
                        $errors["richmenu_content"] =   "richmenu content does not exist.";
                    }
                }
            }
            $this->status           =   $status;
            $this->error_details    =   $errors;
            $this->save();
        }
        return $this;
    }

    static function convert_areas($areas) {
        $areas  =   $areas ?? array();
        $areas  =   array_filter($areas,fn($area)=>self::validate_area($area));
        $areas  =   array_values($areas);
        return $areas;
    }
    static function validate_area($area)
    {
        $validation =   true;
        $validation =   $validation ? ($area["bounds"]["x"] ?? null) != null                                : $validation;
        $validation =   $validation ? ($area["bounds"]["y"] ?? null) != null                                : $validation;
        $validation =   $validation ? ($area["bounds"]["width"] ?? null) != null                            : $validation;
        $validation =   $validation ? ($area["bounds"]["height"] ?? null) != null                           : $validation;
        $validation =   $validation ? in_array(($area["action"]["type"] ?? null),array_keys(self::$types))  : $validation;
        return $validation;
    }


    /** Storage */
        static $mimetypes          =   array(
            "image/jpeg"    =>  "jpg",
            "image/png"     =>  "png",
        );
        public function create_richmenu_content($file)
        {
            $app                =   $this->app ?? new App();
            $client_id          =   $app->client_id;
            $app_richmenu_id    =   $this->id;
            $mimetype           =   $file->header("Content-Type");
            $extension          =   self::$mimetypes[$mimetype]   ??  "jpg";
            $directory          =   "public/app/$client_id/richmenu_content";
            $filename           =   "$app_richmenu_id.$extension";
            $path               =   "$directory/$filename";
            $content            =   $file->getBody()->getContents();
            Storage::makeDirectory($directory);
            Storage::put($path,$content);
            return Storage::get($path);
        }

        public function get_richmenu_content_file()
        {
            $app                    =   $this->app ?? new App();
            $id                     =   $this->id;
            $directory              =   "public/app/$app->client_id/richmenu_content";
            $richmenu_content_file  =   "";
            $richmenu_content_file  =   Storage::exists("$directory/$id.png") ? Storage::get("$directory/$id.png") : $richmenu_content_file;
            $richmenu_content_file  =   Storage::exists("$directory/$id.jpg") ? Storage::get("$directory/$id.jpg") : $richmenu_content_file;
            return $richmenu_content_file;
        }
        public function get_richmenu_content_delete()
        {
            $app                    =   $this->app ?? new App();
            $id                     =   $this->id;
            $directory              =   "public/app/$app->client_id/richmenu_content";
            Storage::exists("$directory/$id.png") ? Storage::delete("$directory/$id.png")   :   null;
            Storage::exists("$directory/$id.jpg") ? Storage::delete("$directory/$id.jpg")   :   null;
        }
        public function get_richmenu_content_exists()
        {
            $app                        =   $this->app ?? new App();
            $id                         =   $this->id;
            $directory                  =   "public/app/$app->client_id/richmenu_content";
            $richmenu_content_exists    =   false;
            $richmenu_content_exists    =   $richmenu_content_exists ? $richmenu_content_exists : Storage::exists("$directory/$id.png");
            $richmenu_content_exists    =   $richmenu_content_exists ? $richmenu_content_exists : Storage::exists("$directory/$id.jpg");
            return $richmenu_content_exists;
        }
        public function get_richmenu_content_url()
        {
            $app                    =   $this->app ?? new App();
            $id                     =   $this->id;
            $directory              =   "public/app/$app->client_id/richmenu_content";
            $richmenu_content_url   =   "";
            $richmenu_content_url   =   Storage::exists("$directory/$id.png") ? Storage::url("$directory/$id.png") : $richmenu_content_url;
            $richmenu_content_url   =   Storage::exists("$directory/$id.jpg") ? Storage::url("$directory/$id.jpg") : $richmenu_content_url;
            return $richmenu_content_url;
        }
        public function get_richmenu_content_mimetype()
        {
            $app                        =   $this->app ?? new App();
            $id                         =   $this->id;
            $directory                  =   "public/app/$app->client_id/richmenu_content";
            $richmenu_content_mimetype  =   "";
            $richmenu_content_mimetype  =   Storage::exists("$directory/$id.png") ? Storage::mimeType("$directory/$id.png") : $richmenu_content_mimetype;
            $richmenu_content_mimetype  =   Storage::exists("$directory/$id.jpg") ? Storage::mimeType("$directory/$id.jpg") : $richmenu_content_mimetype;
            return $richmenu_content_mimetype;
        }
        public function get_richmenu_content_base64()
        {
            $richmenu_content_file          =   $this->get_richmenu_content_file();
            $richmenu_content_mimetype      =   $this->get_richmenu_content_mimetype();
            $base64                         =   base64_encode($richmenu_content_file);
            $richmenu_content_file_base64   =   "data:$richmenu_content_mimetype;base64,$base64";
            return $richmenu_content_file_base64;
        }

    /** Messaging Api */
        public function create_data()
        {
            $data   =   array(
                "name"          =>  $this->name,
                "chatBarText"   =>  $this->chat_bar_text,
                "selected"      =>  $this->selected,
                "size"          =>  $this->size,
                "areas"         =>  $this->areas,
            );
            return $data;
        }
        public function get_richmenu_content()
        {
            $app            =   $this->app ?? new App();
            $richmenu_id    =   $this->richmenu_id;
            $response       =   MessagingApi::get_richmenu_content($app->channel_access_token, $richmenu_id);
            return $response;
        }

        public function validate_richmenu()
        {
            $app        =   $this->app ?? new App();
            $data       =   $this->create_data();
            $response   =   MessagingApi::validate_richmemu($app->channel_access_token, $data);
            return $response;
        }
        public function post_richmenu()
        {
            $app        =   $this->app ?? new App();
            $data       =   $this->create_data();
            $richmemu   =   MessagingApi::post_richmemu($app->channel_access_token, $data);
            if($richmemu->successful()){
                $richmenu_id                =   $richmemu->json("richMenuId") ?? null;
                $richmenu_content_file      =   $this->get_richmenu_content_file();
                $richmenu_content_mimetype  =   $this->get_richmenu_content_mimetype();
                $richmenu_content           =   MessagingApi::post_richmenu_content($app->channel_access_token, $richmenu_id, $richmenu_content_file, $richmenu_content_mimetype);
                if($richmenu_content->successful()){
                    $this->richmenu_id  =   $richmenu_id;
                    $this->status       =   "active";
                    $this->save();
                } else {
                    $this->latest();
                }
            }
        }
        public function delete_richmenu()
        {
            $app                =   $this->app ?? new App();
            $richmenu_id        =   $this->richmenu_id;
            $response           =   MessagingApi::delete_richmemu($app->channel_access_token, $richmenu_id);
            $this->richmenu_id  =   null;
            $this->save();
            return $response;
        }
        static function update_richmenus($app)
        {
            $richmenus      =   MessagingApi::get_richmenus($app->channel_access_token)->json("richmenus");
            foreach($richmenus as $richmemu){
                $richmenu_id    =   $richmemu["richMenuId"] ?? null;
                if($richmenu_id){
                    $app_richmenu   =   AppRichmenu::updateOrCreate(array(
                        "app_id"        =>  $app->id,
                        "richmenu_id"   =>  $richmenu_id,
                    ));
                }
            }
            $app->richmenus->each(fn($app_richmemu)=>$app_richmemu->latest());
        }
        /** defualt menu */
        public function is_default()
        {
            $app                    =   $this->app ?? new App();
            $richmenu_id            =   $this->richmenu_id;
            $richmemu_default_id    =   MessagingApi::get_richmemu_default($app->channel_access_token)->json("richMenuId");
            return $richmenu_id && $richmemu_default_id && $richmenu_id == $richmemu_default_id; 
        }
        public function post_richmenu_default()
        {
            $app            =   $this->app ?? new App();
            $richmenu_id    =   $this->richmenu_id;
            $response       =   MessagingApi::post_richmemu_default($app->channel_access_token, $richmenu_id);
            return $response;
        }
    

    
}
