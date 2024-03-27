<?php

namespace App\Models\Webapp;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Company extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    protected $fillable = array(
        "code",
        "name",
        "kana",
        "tel",
        "fax",
        "cutoff",
        "collect",
        "is_write",
    );

    public static function rules($request = null)
    {
        $rules = array(
            "code"      =>  array("required"),
            "name"      =>  array("required"),
            "kana"      =>  array("required"),
            "tel"       =>  array("required"),
            "fax"       =>  array("nullable"),
            "cutoff"    =>  array("nullable"),
            "collect"   =>  array("nullable"),
            "is_write"  =>  array("nullable"),
        );
        return $rules;
    } 

    public function get_short_name()
    {
        return str_replace(array("株式会社","有限会社","合同会社","合資会社",), "", $this->name);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "user_companies", 'company_id', 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(CompanyAddress::class);
    }

    public function emails()
    {
        return $this->hasMany(CompanyEmail::class);
    }

    public function provides()
    {
        return $this->hasMany(CompanyProvideProduct::class);
    }

}
