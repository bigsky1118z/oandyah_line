<?php

namespace App\Models\Sns;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sns extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "user_id",
        "name",
        "title",
        "description",
    );

    public function links($type = null, $value = null)
    {
        if($type && $value){
            return $this->hasOne(SnsLink::class)->whereType($type)->whereValue($value);
        } else {
            return $this->hasMany(SnsLink::class)->orderBy("order");
        }
    }
    public function configs($name = null)
    {
        if($name){
            return $this->hasOne(SnsConfig::class)->whereName($name);
        } else {
            return $this->hasMany(SnsConfig::class);
        }
    }
    

    public function image_url_icon(){
        if (file_exists(public_path("storage/sns/icon/" . $this->name . ".png"))) {
            return "/storage/sns/icon/$this->name.png";
        } elseif(file_exists(public_path("storage/sns/icon/" . $this->name . ".jpg"))) {
            return "/storage/sns/icon/$this->name.jpg";
        } else {
            return "/storage/sns/icon/default.png";
        }
    }

    public function set_config($name, $value)
    {
        SnsConfig::updateOrCreate(array(
            "sns_id"    =>  $this->id,
            "name"      =>  $name,
        ),array(
            "value"     =>  $value,
        ));
    }

    public function get_config($name)
    {
        return SnsConfig::whereSnsId($this->id)->whereName($name)->exists() ? SnsConfig::whereSnsId($this->id)->whereName($name)->first()->value : null ;
    }
}
