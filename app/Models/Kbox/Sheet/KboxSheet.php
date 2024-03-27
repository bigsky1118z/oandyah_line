<?php

namespace App\Models\Kbox\Sheet;

use App\Models\Kbox\Company\KboxCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxSheet extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "name",
        "color",
        "supplier",
        "manufacturer",
    );

    public function supplier()
    {
        return $this->hasOne(KboxCompany::class, "id", "supplier_id");
    }
    public function manufacturer()
    {
        return $this->hasOne(KboxCompany::class, "id", "manufacturer_id");
    }

    public function grams()
    {
        return $this->hasMany(KboxSheetGram::class);
    }

    public function gram($gram)
    {
        return $this->hasOne(KboxSheetGram::class)->whereGram($gram);
    }

    public function set_gram($gram)
    {
        $sheet_gram =   KboxSheetGram::updateOrCreate(
            array(
                "kbox_sheet_id" =>  $this->id,
                "gram"          =>  $gram,
            ),
            array()
        );
        return $sheet_gram;
    }

    public function prices()
    {
        return $this->hasMany(KboxSheetPrice::class);
    }

    public function price()
    {
        return $this->hasOne(KboxSheetPrice::class)->orderByDesc("valid_at")->where("valid_at","<", date("Y-m-d"));
    }

    public function set_price($purchase, $subcontractor, $estimate, $valid_at)
    {
        $sheet_price    =   KboxSheetPrice::updateOrCreate(
            array(
                "kbox_sheet_id" =>  $this->id,
                "valid_at"      =>  $valid_at,
            ),
            array(
                "purchase"      =>  $purchase,
                "subcontractor" =>  $subcontractor,
                "estimate"      =>  $estimate,
            )
        );
        return $sheet_price;
    }
}
