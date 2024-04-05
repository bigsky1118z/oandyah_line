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
        "app_message_object_1_id",
        "app_message_object_2_id",
        "app_message_object_3_id",
        "app_message_object_4_id",
        "app_message_object_5_id",
    ];

    public function message_object_1()
    {
        return $this->hasOne(AppMessageObject::class,"id", "app_message_object_1_id");
    }
    public function message_object_2()
    {
        return $this->hasOne(AppMessageObject::class,"id", "app_message_object_2_id");
    }
    public function message_object_3()
    {
        return $this->hasOne(AppMessageObject::class,"id", "app_message_object_3_id");
    }
    public function message_object_4()
    {
        return $this->hasOne(AppMessageObject::class,"id", "app_message_object_4_id");
    }
    public function message_object_5()
    {
        return $this->hasOne(AppMessageObject::class,"id", "app_message_object_5_id");
    }


}
