<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JwebArtist extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "artist_code",
        "artist_link",
        "artist_name",
        "artist_image_thumb_url",
        "artist_furigana",
        "member_code",
        "member_name",
        "member_furigana",
        "member_image_thumb_url",
        "member_date",
    );
}
