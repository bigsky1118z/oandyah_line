<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConfig extends Model
{
    use HasFactory;
    protected $fillable = [
        "key",
        "value",
        "description",
        "enable",
    ];

    protected $casts = [
        "enable" => "boolean",
    ];


}
