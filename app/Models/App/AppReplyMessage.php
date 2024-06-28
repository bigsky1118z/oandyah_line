<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppReplyMessage extends Model
{
    use HasFactory;
    protected $fillable =   [
        "id",
        "app_reply_id",
        "name",
        "messages",
        "status",
    ];
    protected $casts    =   [
        "messages"  =>  "json",
    ];
    
    
}
