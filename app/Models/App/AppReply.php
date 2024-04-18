<?php

namespace App\Models\App;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppReply extends Model
{
    use HasFactory;
    protected $fillable =   [
        "app_id",
        "name",
        "status",
        "messages",
    ];

    protected $casts    =   [
        "messages"  =>  "json",
    ];

    protected $status   =   [
        "draft" =>  "下書き",
        "draft" =>  "下書き",
    ];

    public function app()
    {
        return $this->belongsTo(App::class, "app_id", "id");
    }

    public function conditions()
    {
        return $this->hasMany(AppReplyCondition::class);
    }

    public function num()
    {
        return count($this->messages);
    }

    public function default()
    {
        return $this->hasOne(AppReplyCondition::class)->whereEnable(true)->whereDefault(true)->orderBy("priority");
    }

    public function set_condition($type, $condition = array(), $priority = 100, $enable = true, $default = false)
    {
        AppReplyCondition::updateOrCreate(array(
            "app_id"        =>  $this->app->id,
            "app_reply_id"  =>  $this->id,
            "type"          =>  $type,
            "condition"     =>  $condition,
        ),array(
            "priority"      =>  $priority,
            "enable"        =>  $enable,
            "default"       =>  $default,
        ));
    }
}
