<?php

namespace App\Models\App;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppAutoDefault extends Model
{
    use HasFactory;
    protected $fillable =   [
        "app_id",
        "app_auto_id",
        "type",
    ];

    protected $casts    =   [

    ];

    public function app()
    {
        return $this->belongsTo(App::class, "app_id", "id");
    }

    public function auto()
    {
        return $this->belongsTo(AppAuto::class, "app_auto_id", "id");
    }

}
