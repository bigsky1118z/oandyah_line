<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiOrderUser extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "line_api_order_menu_id",
        "line_api_user_id",
        "name",
        "value",
    );
}
