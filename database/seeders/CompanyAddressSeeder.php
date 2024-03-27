<?php

namespace Database\Seeders;

use App\Models\Webapp\CompanyAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyAddress::create(array(
            "company_id"        =>  1,
            "type"              =>  "本社",
            "zip_code"          =>  "577-0016",
            "prefecture"        =>  "大阪府",
            "city"              =>  "東大阪市",
            "street_address"    =>  "長田西6-1-36",
            "building_name"     =>  null,
        ));

        CompanyAddress::create(array(
            "company_id"        =>  2,
            "type"              =>  "本社",
            "zip_code"          =>  "556-0022",
            "prefecture"        =>  "大阪府",
            "city"              =>  "大阪市浪速区",
            "street_address"    =>  "桜川3-5-4",
            "building_name"     =>  null,
        ));

        CompanyAddress::create(array(
            "company_id"        =>  3,
            "type"              =>  "本社",
            "zip_code"          =>  "579-8004",
            "prefecture"        =>  "大阪府",
            "city"              =>  "東大阪市",
            "street_address"    =>  "布市町3-1-10",
            "building_name"     =>  null,
        ));

    }
}
