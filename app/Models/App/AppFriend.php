<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppFriend extends Model
{
    use HasFactory;
    protected $fillable = [
        "app_id",
        "friend_id",
        "status",
        "display_name",
        "language",
        "picture_url",
        "status_message",
    ];
}
