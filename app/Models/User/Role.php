<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "value",
    );

    public static $roles  =   array(
        "all",
        "admin",
        "client",
        "default",
    );

}
