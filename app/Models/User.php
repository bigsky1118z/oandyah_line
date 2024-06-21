<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\App;
use App\Models\UserApp;
use App\Models\User\UserConfig;
use App\Models\User\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "password",

        "name",
        "birthday",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
        "password"          => "hashed",

        "birthday"          => "date",
    ];

    public function get_config($key)
    {
        if(isset($key)){
            return $this->hasOne(UserConfig::class)->where("key",$key)->first();
        } else {
            return $this->hasMany(UserConfig::class);
        }
    }
    public function post_config($key,$value = null, $description = null, $enable = true)
    {
        $user_config =  UserConfig::updateOrCreate(array(
            "user_id"   =>  $this->id,
            "key"       =>  $key,
        ),array(
            "value"         =>  $value,
            "description"   =>  $description,
            "enable"        =>  $enable,
        ));
        return $user_config;
    }

    public function roles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function apps()
    {
        return $this->hasMany(UserApp::class,"user_id", "id");
    }
    public function app($client_id)
    {
        $app    =   App::where("client_id",$client_id)->first();
        return $this->hasOne(UserApp::class)->where("app_id",$app->id)->first();
    }
    public function regist_app($app)
    {
        $role   =   $app->users()->count() ? "editor" : "admin";
        $user_app = UserApp::updateOrCreate(array(
            "user_id"   =>  $this->id,
            "app_id"    =>  $app->id,
            "role"      =>  $role,
        ));
        return $user_app;
    }
    

    public function get_name()
    {
        $name   =   "";
        $name   =   $name == "" ? ($this->get_config("nickname")->value ?? "") : $name;
        $name   =   $name == "" ? ($this->get_config("last_name")->value ?? "") . ($this->get_config("first_name")->value ?? "") : $name;
        $name   =   $name == "" ? $this->name : $name;
        return  $name;
    }
}
