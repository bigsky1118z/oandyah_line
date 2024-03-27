<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiOrderItem extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "code",
        "category",
        "sub_category",
        "name",
        "size",
        "material",
        "allergy",
        "square_image_url",
        "wide_image_url",
    );

    protected $casts    =   array(
        "material"  =>  "json",
        "allergy"   =>  "json",
    );

    public function display_name()
    {
        $display_name   =   $this->name;
        isset($this->size) ? $display_name .= "($this->size)" : null;
        return $display_name;
    }

    public static $allergies    =   array(
        "えび","かに","くるみ","小麦","そば","卵","乳","落花生",
    );

}
