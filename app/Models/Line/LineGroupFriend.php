<?php

namespace App\Models\Line;

use App\Models\Line\LineFriend;
use App\Models\Line\LineGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineGroupFriend extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_id",
        "line_group_id",
        "line_friend_id",
    );

    public function group()
    {
        return $this->belongsTo(LineGroup::class, "line_group_id")->whereLineId($this->line_id);
    }

    public function friend()
    {
        return $this->belongsTo(LineFriend::class, "line_friend_id")->whereLineId($this->line_id);
    }

}
