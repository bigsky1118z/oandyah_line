<?php

namespace App\Models\Website\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageMenuLink extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_menu_id",
        "path",
        "title",
        "description",
        "image_thumbnail_url",
        "order",
    );

    
}
