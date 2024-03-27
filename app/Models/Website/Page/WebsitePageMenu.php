<?php

namespace App\Models\Website\Page;

use App\Models\Website\WebsitePage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageMenu extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_id",
    );

    public function links($link_id = null)
    {
        if($link_id){
            return $this->hasOne(WebsitePageMenuLink::class)->whereId($link_id)->first();
        } else {
            return $this->hasMany(WebsitePageMenuLink::class)->whereNotNull("order")->orderBy("order")->orderBy("id");
        }
    }
}
