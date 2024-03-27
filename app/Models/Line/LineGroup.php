<?php

namespace App\Models\Line;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineGroup extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_id",
        "name",
        "title",
        "description",
    );

    public function friends()
    {
        return $this->hasMany(LineGroupFriend::class)->whereLineId($this->line_id);
    }
}
