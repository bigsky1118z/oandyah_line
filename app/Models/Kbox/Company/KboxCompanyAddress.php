<?php

namespace App\Models\Kbox\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxCompanyAddress extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "kbox_company_id",
        "type",
        "zip_code",
        "prefecture",
        "city",
        "town",
        "other",
    );

    public function company()
    {
        return $this->belongsTo(KboxCompany::class, "kbox_company_id");
    }

    public function full_address(){
        return $this->prefecture . $this->city . $this->town . $this->other;
    }

    public function short_address(){
        return $this->city . $this->town . $this->other;
    }

}
