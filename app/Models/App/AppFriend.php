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

    public function get_name()
    {
        $name   =   $this->friend_id;
        $name   =   $this->display_name ?? $name;
        return $name;
    }
}
