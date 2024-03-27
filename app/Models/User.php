<?php

namespace App\Models;

use App\Models\Sns\Sns;
use App\Models\User\Role;
use App\Models\User\Subdirectory;
use App\Models\User\UserBirthday;
use App\Models\User\UserName;
use App\Models\User\UserSubdirectoryRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rules\Password;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = array(
        "email",
        "email_verified_at",
        "password",
    );


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = array(
        'password',
        'remember_token',
    );

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = array(
        'email_verified_at' => 'datetime',
    );

    public static $rules = array(
        'user.email'     =>  array('required', 'unique:users,email'),
        'user.password'  =>  array('required'),
    );

    public function name()
    {
        return $this->hasOne(UserName::class);
    }

    public function birthday()
    {
        return $this->hasOne(UserBirthday::class);
    }

    public function subdirectory_roles($subdirectory = null)
    {
        $subdirectory   =   Subdirectory::whereValue($subdirectory)->first();
        if($subdirectory){
            return $this->hasMany(UserSubdirectoryRole::class)->whereSubdirectoryId($subdirectory->id)->get();
        } else {
            return $this->hasMany(UserSubdirectoryRole::class);
        }
    }

    public function is_admin()
    {
        $authority_ids  =   array();
        $role_ids       =   $this->subdirectory_roles("website")->pluck('role_id')->toArray();
        foreach(array("all", "admin") as $value){
            $role   =   Role::whereValue($value)->first();
            $role   ?   $authority_ids[] = $role->id : null;
        }
        return array_intersect($role_ids, $authority_ids);
    }

    public function set_birthday($year = null, $month = null, $day = null, $hours = null, $minutes = null ,$place = null)
    {
        UserBirthday::updateOrCreate(
            array(
                "user_id"   =>  $this->id,
            ),
            array(
                "year"      =>  $year,
                "month"     =>  $month,
                "day"       =>  $day,
                "hours"     =>  $hours,
                "minutes"   =>  $minutes,
                "place"     =>  $place,
            )
        );
    }

    public function set_name($type, $name1, $name2 = null, $name3 = null, $name4 = null)
    {
        switch($type){
            case "jp":
            case "kana":
            case "en":
                UserName::updateOrCreate(
                    array(
                        "user_id"           =>  $this->id,
                    ),
                    array(
                        "last_name_$type"   =>   $name1,
                        "first_name_$type"  =>   $name2,
                        "middle_name_$type" =>   $name3,
                        "maiden_name_$type" =>   $name4,
                    )
                );
                break;
            case "nickname":
            case "naming":
            case "honorific_title":
                UserName::updateOrCreate(
                    array(
                        "user_id"   =>  $this->id,
                    ),
                    array(
                        "$type"     =>   $name1,
                    )
                );
                break;
            }
    }

    public function set_subdirectory_role($subdirectory, $role = null)
    {
        $subdirectory   =   Subdirectory::whereValue($subdirectory)->first();
        if($subdirectory){
            $role   =   Role::whereValue($role)->exists() ? Role::whereValue($role)->first() : Role::whereValue("default")->first();
            UserSubdirectoryRole::updateOrCreate(array(
                "user_id"           =>  $this->id,
                "subdirectory_id"   =>  $subdirectory->id,
                "role_id"           =>  $role->id,
            ),array());
        } else {

        }
    }

    public function delete_subdirectory_role($subdirectory, $role = null)
    {
        $subdirectory   =   Subdirectory::whereValue($subdirectory)->first();
        if($role){
            $role   =   Role::whereValue($role)->first();
            UserSubdirectoryRole::whereUserId($this->id)
            ->whereSubdirectoryId($subdirectory->id)
            ->whereRoleId($role->id)->delete();
        } else {
            $role   =   Role::whereValue($role)->first();
            UserSubdirectoryRole::whereUserId($this->id)
            ->whereSubdirectoryId($subdirectory->id)->delete();
        }
    }

}
