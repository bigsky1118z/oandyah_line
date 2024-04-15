<?php

namespace App\Models\App;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppAuto extends Model
{
    use HasFactory;
    protected $fillable =   [
        "app_id",
        "type",
        "name",
        "app_message_id",
        "condition",
        "priority",
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

    public function app()
    {
        return $this->belongsTo(App::class, "app_id", "id");
    }

    public function default()
    {
        return $this->hasOne(AppAutoDefault::class)->whereType($this->type);
    }

    public function message()
    {
        return $this->belongsTo(AppMessage::class,"app_message_id", "id");
    }

    public function set_default()
    {
        AppAutoDefault::updateOrCreate(array(
            "app_id"        =>  $this->app->id,
            "type"          =>  $this->type,
        ),array(
            "app_auto_id"   =>  $this->id,
        ));
    }

    public function is_default()
    {
        return !!$this->default;
    }
}
