<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jweb extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "type",
        "code",
        "code1",
        "name",
        "artist_code",
        "artist_name",
        "category_code",
        "date",
        "image_url",
        "inbox_flag1",
        "inbox_type",
        "inbox_thumb",
        "caption",
        "link",
    );
}
