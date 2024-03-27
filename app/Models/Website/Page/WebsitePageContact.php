<?php

namespace App\Models\Website\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageContact extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_id",
    );

    public function forms($form_id = null)
    {
        if($form_id){
            return $this->hasOne(WebsitePageContactForm::class)->whereId($form_id)->first();
        } else {
            return $this->hasMany(WebsitePageContactForm::class)->orderBy("active", "desc")->orderBy("order")->orderBy("id");
        }
    }

    public function posts($post_id = null)
    {
        if($post_id){
            return $this->hasOne(WebsitePageContactPost::class)->whereId($post_id)->first();
        } else {
            return $this->hasMany(WebsitePageContactPost::class)->orderBy("id", "desc");
        }
    }
    public function set_post($values)
    {
        WebsitePageContactPost::Create(array(
            "website_page_contact_id"   =>  $this->id,
            "values"                     =>  $values,
            "status"                    =>  "pending",
        ));
    }

}
