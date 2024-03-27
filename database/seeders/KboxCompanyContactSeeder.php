<?php

namespace Database\Seeders;

use App\Models\Kbox\Company\KboxCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KboxCompanyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv    =   Storage::disk("kbox")->get("company/kbox_company_contacts.csv");
        if($csv){
            $kbox_company_contacts =   array();
            foreach(explode(PHP_EOL, $csv) as $line){
                $line ? $kbox_company_contacts[] = str_getcsv($line) : null;
            }
            $headers    =   array_shift($kbox_company_contacts);
            foreach($kbox_company_contacts as $kbox_company_contact){
                if(count($headers) == count($kbox_company_contact)){
                    $company    =   KboxCompany::whereName($kbox_company_contact[array_search("kbox_company", $headers)])->first();
                    if($company){
                        $type           =   $kbox_company_contact[array_search("type", $headers)];
                        $category       =   $kbox_company_contact[array_search("category", $headers)];
                        $name           =   $kbox_company_contact[array_search("name", $headers)];
                        $value          =   $kbox_company_contact[array_search("value", $headers)];
                        $description    =   $kbox_company_contact[array_search("description", $headers)];
                        $company->set_contact($type, $category, $name, $value, $description);
                    }
                }
            }
        }
    }
}
