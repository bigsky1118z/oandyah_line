<?php

namespace App\Models\Line\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineMessageLocation extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_id",

        "name",
        "status",
        "validate",

        "title",
        "address",
        "latitude",
        "longitude",
    );

    public function get_object()
    {
        if($this->title && $this->address && $this->latitude && $this->longitude){
            $object =   array(
                "type"      =>  "location",
                "title"     =>  $this->title,
                "address"   =>  $this->address,
                "latitude"  =>  $this->latitude,
                "longitude" =>  $this->longitude,
            );
            return $object;
        } else {
            return null;
        }
    }
    public function get_html()
    {
        return "<p>$this->title（$this->address）</p>";
    }


}
