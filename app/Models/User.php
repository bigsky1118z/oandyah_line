<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

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
        // "name",
        "email",
        "password",

        "user_name",
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
    ];

    public function get_config($key)
    {
        if(isset($key)){
            return $this->hasOne(UserConfig::class)->where("key",$key);
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


}
