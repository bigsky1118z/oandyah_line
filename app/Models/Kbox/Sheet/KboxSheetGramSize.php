<?php

namespace App\Models\Kbox\Sheet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxSheetGramSize extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "kbox_sheet_gram_id",
        "width",
        "length",
    );

    public function sheet()
    {
        return $this->belongsTo(KboxSheet::class, "kbox_sheet_id");
    }

    public function gram()
    {
        return $this->belongsTo(KboxSheetGram::class,"kbox_sheet_gram_id");
    }


    public function grammage ()
    {
        $grammage   =   ($this->length / 1000) * ($this->width / 1000) * ($this->gram->gram / 1000) * 100;
        $condition  =   ($grammage * 10) % 10;
        switch($grammage){
            case 8 <= $condition:
                $grammage   =   round($grammage, 0);
                break;
            case 3 <= $condition:
                $grammage   =   floor($grammage) + 0.5;
                break;
            case 0 <= $condition:
            default:
                $grammage   =   round($grammage, 0);
                break;
        }
        return $grammage;
    }


}
