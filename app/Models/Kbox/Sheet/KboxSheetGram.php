<?php

namespace App\Models\Kbox\Sheet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxSheetGram extends Model
{
    use HasFactory;

    protected $fillable = array(
        "kbox_sheet_id",
        "gram",
    );

    public function sheet()
    {
        return $this->belongsTo(KboxSheet::class, "kbox_sheet_id");
    }

    public function gauge()
    {
        return $this->gram / 50;
    }


    public function sizes()
    {
        return $this->hasMany(KboxSheetGramSize::class);
    }

    public function size($length ,$width)
    {
        return $this->hasOne(KboxSheetGram::class)->whereLength($length)->whereWidth($width);
    }

    public function set_size($length, $width)
    {
        KboxSheetGramSize::updateOrCreate(
            array(
                "kbox_sheet_gram_id"    =>  $this->id,
                "length"                =>  $length,
                "width"                 =>  $width,
            ),
            array() 
        );
    }

}
