<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    use HasFactory;
    protected $fillable = [
        "app_id",
        "user_id",
        "status",
        "display_name",
        "language",
        "picture_url",
        "status_message",
        "naming",
    ];
}
