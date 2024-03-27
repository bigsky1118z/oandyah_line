<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "type",
        "zip_code",
        "prefecture",
        "city",
        "street_address",
        "building_name",
    );

    public function get_full_address()
    {
        $address    =   array(
            $this->prefecture,
            $this->city,
            $this->street_address,
            $this->building_name,
        );
        return implode("",array_filter($address));
    }
}
