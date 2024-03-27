<?php

namespace App\Models\Line;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineFriendName extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_friend_id",
        "last_name_jp",
        "last_name_kana",
        "last_name_en",
        "middle_name_jp",
        "middle_name_kana",
        "middle_name_en",
        "first_name_jp",
        "first_name_kana",
        "first_name_en",
        "maiden_name_jp",
        "maiden_name_kana",
        "maiden_name_en",
        "nickname",
        "honorific_title",
    );
}
