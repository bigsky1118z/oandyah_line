<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubdirectoryRole extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "user_id",
        "subdirectory_id",
        "role_id",
    );

    public function subdirectory()
    {
        return $this->belongsTo(Subdirectory::class, "subdirectory_id");
    }

    public function role()
    {
        return $this->belongsTo(Role::class, "role_id");
    }

}
