<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppMessage extends Model
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

    public function num()
    {
        return count($this->messages);
    }
}
