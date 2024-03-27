<?php

namespace App\Models\Kbox\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KboxCompany extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "category",
        "code",
        "name",
        "kana",
        "company_type",
    );

    public static $company_types    =   array(
        "_株式会社" =>  "〇〇株式会社",
        "株式会社_" =>  "株式会社〇〇",
        "_有限会社" =>  "〇〇有限会社",
        "有限会社_" =>  "有限会社〇〇",
        "_合同会社" =>  "〇〇合同会社",
        "合同会社_" =>  "合同会社〇〇",
        "_協業組合" =>  "〇〇協業組合",
        "協業組合_" =>  "協業組合〇〇",
        "_合資会社" =>  "〇〇合資会社",
        "合資会社_" =>  "合資会社〇〇",
    );

    public static function backup_csv($database)
    {
        Storage::disk("kbox")->exists("company")            ?   Storage::disk("kbox")->makeDirectory("company", 0775, true)             :   null;
        Storage::disk("kbox")->exists("company/$database")  ?   Storage::disk("kbox")->makeDirectory("company/$database", 0775, true)   :   null;
        KboxCompany::generate_csv($database);
        $contents   =   file_get_contents($database . ".csv");
        Storage::disk("kbox")->put("company" . "/" . $database . ".csv", $contents);
    }

    public static function generate_csv($database)
    {
        $csv        =   fopen($database . ".csv","w+");
        switch($database){
            case "kbox_companies":
                $companies  =   KboxCompany::all();
                $headers    =   array("id", "category", "code", "name", "kana", "company_type");
                fputcsv($csv, $headers);
                foreach($companies as $company){
                    $array  =   array_map(fn($header)=>$company[$header], $headers);
                    count($array) ? fputcsv($csv, $array) : null;
                }
                break;
            case "kbox_company_addresses":
                $addresses  =   KboxCompanyAddress::all();
                $headers    =   array("id", "kbox_company", "name", "zip_code", "prefecture", "city", "town", "other");
                fputcsv($csv, $headers);
                foreach($addresses as $address){
                    $array  =   array_map(fn($header)=>$header == "kbox_company" ? $address->company->name : $address[$header] , $headers);
                    count($array) ? fputcsv($csv, $array) : null;
                }
                break;
            case "kbox_company_contacts":
                $contacts   =   KboxCompanyContact::all();
                $headers    =   array("id", "kbox_company", "type", "category","name", "value", "description");
                fputcsv($csv, $headers);
                foreach($contacts as $contact){
                    $array  =   array_map(fn($header)=>$header == "kbox_company" ? $contact->company->name : $contact[$header] , $headers);
                    count($array) ? fputcsv($csv, $array) : null;
                }
                break;
            case "kbox_company_slips":
                $slips   =   KboxCompanySlip::all();
                $headers    =   array("id", "kbox_company", "type", "price", "total", "description");
                fputcsv($csv, $headers);
                foreach($slips as $slip){
                    $array  =   array_map(fn($header)=>$header == "kbox_company" ? $slip->company->name : $slip[$header] , $headers);
                    count($array) ? fputcsv($csv, $array) : null;
                }
                break;
            }
        fclose($csv);
        return $csv;
    }

    public function official_name(){
        $official_name  =   $this->name;
        if(Str::startsWith($this->company_type, '_')){
            $official_name  =   $this->name . Str::replace("_","",$this->company_type);
        }
        if(Str::endsWith($this->company_type, '_')){
            $official_name  =   Str::replace("_","",$this->company_type) . $this->name;
        }
        return $official_name;
    }

    public function addresses()
    {
        return $this->hasMany(KboxCompanyAddress::class);
    }

    public function address($name = "本社")
    {
        return $this->hasOne(KboxCompanyAddress::class)->whereName($name);
    }

    public function set_address($name, $zip_code, $prefecture, $city, $town, $other = null)
    {
        KboxCompanyAddress::updateOrCreate(
            array(
                "kbox_company_id"   =>  $this->id,
                "name"              =>  $name ? $name : "本社",
            ),
            array(
                "zip_code"      =>  $zip_code,
                "prefecture"    =>  $prefecture,
                "city"          =>  $city,
                "town"          =>  $town,
                "other"         =>  $other,
            )
        );
    }

    public function contacts()
    {
        return $this->hasMany(KboxCompanyContact::class);
    }

    public function contact($type = "tel", $category = "本社")
    {
        return $this->hasOne(KboxCompanyContact::class)->whereType($type)->whereCategory($category);
    }

    public function set_contact($type, $category = "本社", $name = null, $value, $description = null)
    {
        KboxCompanyContact::updateOrCreate(
            array(
                "kbox_company_id"   =>  $this->id,
                "type"              =>  $type,
                "category"          =>  $category,
                "name"              =>  $name,
            ),
            array(
                "value"             =>  $value,
                "description"       =>  $description,
            )
        );
    }

    public function billings(){
        return $this->hasMany(KboxCompanyBilling::class);
    }


    public function billing($name){
        if($name){
            return $this->hasOne(KboxCompanyBilling::class)->whereName($name);
        } else {
            return $this->hasOne(KboxCompanyBilling::class);
        }
    }


    public function set_billing($closing_date, $payment_date, $name = "本社", $description = null)
    {
        $address    =   KboxCompanyAddress::whereKboxCompanyId($this->id)->whereName($name)->first();
        $address    ?   null : $address = KboxCompanyAddress::whereKboxCompanyId($this->id)->whereName("本社")->first();
        $address    ?   null : $address = KboxCompanyAddress::whereKboxCompanyId($this->id)->first();
        if($address){
            KboxCompanyBilling::updateOrCreate(
                array(
                    "kbox_company_id"           =>  $this->id,
                    "kbox_company_address_id"   =>  $address->id,
                ),
                array(
                    "closing_date"  =>  $closing_date,
                    "payment_date"  =>  $payment_date,
                    "description"   =>  $description,
                )
            );
        }
    }

    public function slip()
    {
        return $this->hasOne(KboxCompanySlip::class, "kbox_company_id");
    }

    public function set_slip($type, $price, $total, $description)
    {
        KboxCompanySlip::updateOrCreate(
            array(
                "kbox_company_id"   =>  $this->id,
            ),
            array(
                "type"              =>  $type,
                "price"             =>  $price,
                "total"             =>  $total,
                "description"       =>  $description,
            )
        );
    }
}
