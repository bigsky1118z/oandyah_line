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

}
