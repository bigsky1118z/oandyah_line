<?php

namespace App\Models\Kbox\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxCompanySlip extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "kbox_company_id",
        "price",
        "total",
        "description",
    );

    protected $casts    =   array(
        "price" =>  "boolean",
        "total" =>  "boolean",
    );

    public function company()
    {
        return $this->belongsTo(KboxCompany::class, "kbox_company_id");
    }

}
