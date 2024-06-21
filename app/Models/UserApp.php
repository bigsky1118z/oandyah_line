<?php

namespace App\Models;

use App\Models\App;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    use HasFactory;

    protected $fillable =   [
        "id",
        "user_id",
        "app_id",
        "role",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function app(){
        return $this->belongsTo(App::class);
    }
}
