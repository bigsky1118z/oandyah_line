<?php

namespace App\Models\Website\Page;

use App\Models\User;
use App\Models\Website\WebsiteConfig;
use App\Models\Website\WebsiteMembershipUser;
use App\Models\Website\WebsitePage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageSingle extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_id",
        "body",
    );

    public function page()
    {
        return $this->belongsTo(WebsitePage::class,"website_page_id");
    }



    public function private()
    {
        return WebsiteConfig::where("name","private")->exists() ? WebsiteConfig::where("name","private")->first()->value : null;
    }

}
