<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteMembership extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "name",
        "grade",
        "discription",
    );

    public function users()
    {
        return $this->hasMany(WebsiteMembershipUser::class, "website_membership_id");
    }

    public function user_ids()
    {
        return $this->users->pluck("user_id")->toArray();
    }

    public function add_user($user_id)
    {
        WebsiteMembershipUser::Create(array(
            "website_membership_id"  =>  $this->id,
            "user_id"     =>  $user_id,
        ));
    }

    public function remove_user($user_id)
    {
        $this->users()->whereUserId($user_id)->delete();
    }

    // public function is_member()
    // {
    //     $memberships    =   $this->memberships;
    //     if($memberships->isEmpty()){
    //         return true;
    //     }else{
    //         $user_id        =   auth()->id();
    //         foreach($memberships as $membership){
    //             if($membership->membership->users()->where("user_id",$user_id)->exists()){
    //                 return true;
    //             }
    //         }
    //     }
    //     return false;
    // }

}
