<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppAuto extends Model
{
    use HasFactory;
    protected $fillable =   [
        "app_id",
        "type",
        "condition",
        "app_message_id",
        "enable",
    ];

    protected $casts    =   [
        "condition" =>  "json",
        "enable"    =>  "boolean",
    ];

    static $matchs  =   [
        "exact_match"       =>  "完全一致",
        "forward_match"     =>  "前方一致",
        "backward_match"    =>  "後方一致",
        "partial_match"     =>  "部分一致",
    ];

    public function message()
    {
        return $this->belongsTo(AppMessage::class,"app_message_id", "id");
    }
}
