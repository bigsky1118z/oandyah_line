<?php

namespace App\Models\Kbox\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxCompanyBilling extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "kbox_company_id",
        "kbox_company_address_id",
        "closing_date",
        "payment_date",
        "descripttion",
    );
    public function company()
    {
        return $this->belongsTo(KboxCompany::class, "kbox_company_id");
    }

    public function address()
    {
        return $this->belongsTo(KboxCompanyAddress::class, "kbox_company_address_id");
    }
}
