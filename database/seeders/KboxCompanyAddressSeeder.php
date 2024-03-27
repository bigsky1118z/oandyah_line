<?php

namespace Database\Seeders;

use App\Models\Kbox\Company\KboxCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KboxCompanyAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv    =   Storage::disk("kbox")->get("company/kbox_company_addresses.csv");
        if($csv){
            $kbox_company_addresses =   array();
            foreach(explode(PHP_EOL, $csv) as $line){
                $line ? $kbox_company_addresses[] = str_getcsv($line) : null;
            }
            $headers    =   array_shift($kbox_company_addresses);
            foreach($kbox_company_addresses as $kbox_company_address){
                if(count($headers) == count($kbox_company_address)){
                    $company    =   KboxCompany::whereName($kbox_company_address[array_search("kbox_company", $headers)])->first();
                    if($company){
                        $name       =   $kbox_company_address[array_search("name", $headers)];
                        $zip_code   =   $kbox_company_address[array_search("zip_code", $headers)];
                        $prefecture =   $kbox_company_address[array_search("prefecture", $headers)];
                        $city       =   $kbox_company_address[array_search("city", $headers)];
                        $town       =   $kbox_company_address[array_search("town", $headers)];
                        $other      =   $kbox_company_address[array_search("other", $headers)];
                        $company->set_address($name, $zip_code, $prefecture, $city, $town, $other);
                    }
                }
            }
        }
    }
}
