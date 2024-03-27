<?php

namespace App\Models\Website\Page;

use App\Models\Website\WebsitePage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageMultiple extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_id",
    );

    public function articles($article_id = null)
    {
        if($article_id){
            return $this->hasOne(WebsitePageMultipleArticle::class)->whereId($article_id)->first();
        } else {
            return $this->hasMany(WebsitePageMultipleArticle::class);
        }
    }

    public function published_articles()
    {
        return $this->hasMany(WebsitePageMultipleArticle::class)->where(function ($query) {
            $query->where('status', 'published')
            ->where('valid_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
            });
        });
    }


    public function is_published()
    {
        if($this->status != "published"){
            return false;
        }
        if($this->valid_at >= date("Y-m-d H:i:s")){
            return false;
        }
        if($this->expired_at && $this->expired_at < date("Y-m-d H:i:s")){
            return false;
        }
        return  true;
    }

    public function page()
    {
        return $this->belongsTo(WebsitePage::class,"website_page_id");
    }

    public function memberships()
    {
        return $this->hasMany(WebsitePageMultipleMembership::class,"website_page_multiple_id");
    }

    public function membership_ids()
    {
        return $this->memberships->pluck("website_membership_id")->toArray();
    }
    public function add_membership($membership_id)
    {
        WebsitePageMultipleMembership::Create(array(
            "website_page_multiple_id"  =>  $this->id,
            "website_membership_id"     =>  $membership_id,
        ));
    }

    public function remove_membership($membership_id)
    {
        $this->memberships()->whereWebsiteMembershipId($membership_id)->delete();
    }

    public function is_member()
    {
        $memberships    =   $this->memberships;
        if($memberships->isEmpty()){
            return true;
        }else{
            $user_id        =   auth()->id();
            foreach($memberships as $membership){
                if($membership->membership->users()->where("user_id",$user_id)->exists()){
                    return true;
                }
            }
        }
        return false;
    }

}
