<?php

namespace App\Models\Kbox\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxCompanyContact extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "kbox_company_id",
        "type",
        "value",
        "category",
        "name",
        "description",
    );

    public function company()
    {
        return $this->belongsTo(KboxCompany::class, "kbox_company_id");
    }

}
