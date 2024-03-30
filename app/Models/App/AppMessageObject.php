<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMessageObject extends Model
{
    use HasFactory;

    protected $fillable =   [
        "type",
        "validate",

        "text",
        "emojis",
        "quote_token",

        "package_id",
        "sticker_id",

        "original_content_url",
        "preview_image_url",
        "tracking_id",
        "duration",
        
        "title",
        "address",
        "latitude",
        "longitude",
        
        "alt_text",
        "base_url",
        "video",
        "actions",
        "template",
        "contents",


    ];
}
