<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiUserUserGroup extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_api_user_group_id",
        "line_api_user_id",
    );

    public function line_api_user()
    {
        return $this->belongsTo(LineApiUser::class);
    }

    public function line_api_user_group()
    {
        return $this->belongsTo(LineApiUserGroup::class);
    }
}
