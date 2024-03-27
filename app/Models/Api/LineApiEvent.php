<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiEvent extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "category",
        "sub_category",
        "event_name",
        "schedule_name",
        "discription",
        "cover_image_url",
        "no_image_url",
        "status",
        "organizer",
        "place",
        "address",
        "price",
        "open_at",
        "start_at",
        "end_at",
        "close_at",
        "count",
        "user_groups",
    );

    protected $casts    =   array(
        "count"         =>  "boolean",
        "user_groups"   =>  "json",
    );

    
    public function line_api_event_attendances()
    {
        return $this->hasMany(LineApiEventAttendance::class)->whereChannelName($this->channel_name);
    }

    public function line_api_event_attendance($line_api_user_id)
    {
        return $this->hasOne(LineApiEventAttendance::class)->whereChannelName($this->channel_name)->whereLineApiUserId($line_api_user_id)->first();
    }

    
    public function user_group_users()
    {
        $user_group_users   =   array();
        if(is_null($this->user_groups)){
            $user_group_users   =   LineApiUser::whereChannelName($this->channel_name)->get();
        }else{
            foreach($this->user_groups as $user_group_id){
                $line_api_user_group    =   LineApiUserGroup::whereChannelName($this->channel_name)->whereId($user_group_id)->first();
                if($line_api_user_group){
                    $line_api_users     =   $line_api_user_group->line_api_users;
                    foreach($line_api_users as $item)
                    $user_group_users[]    =   $item->line_api_user;
                }
            }
            $user_group_users  =   collect($user_group_users)->flatten()->unique();
        }
        return $user_group_users;
    }

}