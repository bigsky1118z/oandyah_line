<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiUserGroup extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "name",
        "description",
        "active",
        "rank",
    );

    protected $casts    =   array(
        "active"    =>  "boolean",
    );

    public function line_api_users()
    {
        return $this->hasMany(LineApiUserUserGroup::class)->where("channel_name",$this->channel_name);
    }
}
