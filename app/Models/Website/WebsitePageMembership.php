<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageMembership extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_id",
        "website_membership_id",
    );

    public function page()
    {
        return $this->belongsTo(WebsitePage::class,"website_page_id");
    }

    public function membership()
    {
        return $this->belongsTo(WebsiteMembership::class,"website_membership_id");
    }
}
