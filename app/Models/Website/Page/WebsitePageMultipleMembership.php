<?php

namespace App\Models\Website\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageMultipleMembership extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_multiple_id",
        "website_membership_id",
    );

    public function multiple()
    {
        return $this->belongsTo(WebsitePage::class,"website_page_multiple_id");
    }

    public function membership()
    {
        return $this->belongsTo(WebsiteMembership::class,"website_membership_id");
    }

}
