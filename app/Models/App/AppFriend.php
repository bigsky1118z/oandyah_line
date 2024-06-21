<?php

namespace App\Models\App;

use App\Library\CsvFile;
use App\Library\MessagingApi;
use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppFriend extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",

        "app_id",

        "friend_id",
        
        "display_name",
        "language",
        "picture_url",
        "status_message",

        "status",
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
            $this->display_name     =   $response["displayName"]    ??  $this->display_name;
            $this->language         =   $response["language"]       ??  $this->language;
            $this->picture_url      =   $response["pictureUrl"]     ??  $this->picture_url;
            $this->status_message   =   $response["statusMessage"]  ??  $this->status_message;
            $this->status           =   "follow";
        } else {
            $this->status           =   "unfollow";
        }
        $this->save();
        return $this;
    }

    /** backup */
        static function get_data()
        {
            $table_name =   (new self)->getTable();
            $columns    =   CsvFile::get_columns($table_name);
            $add        =   array();
            $headers    =   array_merge($columns, $add);
            $all        =   self::all();
            $data       =   array();
            $data[]     =   $headers;
            foreach($all as $one){
                $data[] =   array_map(function($header) use ($one){
                    $value  =   "";
                    switch($header){
                        default:
                            $value  =   $one[$header];
                    }
                    return $value;
                },$headers);
            }
            return $data;
        }

        static function backup()
        {
            $table_name =   (new self)->getTable();
            $data       =   self::get_data();
            $storage    =   CsvFile::backup($data,$table_name);
            return $storage;
        }

        static function download()
        {
            $table_name =   (new self)->getTable();
            $data       =   self::get_data();
            $download   =   CsvFile::download($data, $table_name);
            return $download;
        }
        static function seed()
        {
        }
    
        static function restoration($data)
        {
            foreach($data as $datum){
                if(self::where("friend_id",($datum["friend_id"] ?? null))->exists()){
                    continue;
                }
                $friend =   AppFriend::updateOrCreate(array(
                    "id"                =>  $datum["id"]                ?? null,

                ),array(
                    "app_id"            =>  $datum["app_id"]            ?? null,
                    "friend_id"         =>  $datum["friend_id"]         ?? null,
                    "display_name"      =>  $datum["display_name"]      ?? null,
                    "language"          =>  $datum["language"]          ?? null,
                    "picture_url"       =>  $datum["picture_url"]       ?? null,
                    "status_message"    =>  $datum["status_message"]    ?? null,
                    "status"            =>  $datum["status"]            ?? null,
                ));
            }
        }
    
}
