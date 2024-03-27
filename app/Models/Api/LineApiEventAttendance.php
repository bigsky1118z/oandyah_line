<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiEventAttendance extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "line_api_event_id",
        "line_api_user_id",
        "value",
        "status",
    );

    public function line_api_user()
    {
        return $this->belongsTo(LineApiUser::class);
    }

    public function line_api_event()
    {
        return $this->belongsTo(LineApiEvent::class);
    }
}
