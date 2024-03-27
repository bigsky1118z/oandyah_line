<?php

namespace Database\Seeders;

use App\Models\Kbox\Company\KboxCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KboxCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv    =   Storage::disk("kbox")->get("company/kbox_companies.csv");
        if($csv){
            $kbox_companies =   array();
            foreach(explode(PHP_EOL, $csv) as $line){
                $line ? $kbox_companies[] = str_getcsv($line) : null;
            }
            $headers    =   array_shift($kbox_companies);
            foreach($kbox_companies as $kbox_company){
                if(count($headers) == count($kbox_company)){
                    KboxCompany::Create(array(
                        "category"      =>  $kbox_company[array_search("category", $headers)],
                        "code"          =>  $kbox_company[array_search("code", $headers)],
                        "name"          =>  $kbox_company[array_search("name", $headers)],
                        "kana"          =>  $kbox_company[array_search("kana", $headers)],
                        "company_type"  =>  $kbox_company[array_search("company_type", $headers)],
                    ));
                }
            }
        } else {
            KboxCompany::create(array(
                "category"      =>  "all",
                "code"          =>  "0000",
                "name"          =>  "北角紙器",
                "kana"          =>  "キタズミシキ",
                "company_type"  =>  "_株式会社",
            ));

            KboxCompany::create(array(
                "category"      =>  "supplier",
                "code"          =>  "S0000",
                "name"          =>  "伊藤忠紙パルプ商事",
                "kana"          =>  "イトウチュウカミパルプショウジ",
                "company_type"  =>  "_株式会社",
            ));

            KboxCompany::create(array(
                "category"      =>  "manufacturer",
                "code"          =>  "S0001",
                "name"          =>  "大和板紙",
                "kana"          =>  "ダイワイタガミ",
                "company_type"  =>  "_株式会社",
            ));

            KboxCompany::create(array(
                "category"      =>  "supplier",
                "code"          =>  "S0002",
                "name"          =>  "オービシ",
                "kana"          =>  "オービシ",
                "company_type"  =>  "株式会社_",
            ));

            KboxCompany::create(array(
                "category"      =>  "manufacturer",
                "code"          =>  "S0003",
                "name"          =>  "加賀製紙",
                "kana"          =>  "カガセイシ",
                "company_type"  =>  "_株式会社",
            ));

            KboxCompany::create(array(
                "category"      =>  "supplier",
                "code"          =>  "S0004",
                "name"          =>  "七條紙商事",
                "kana"          =>  "シチジョウカミショウジ",
                "company_type"  =>  "_株式会社",
            ));

            KboxCompany::create(array(
                "category"      =>  "manufacturer",
                "code"          =>  "S0005",
                "name"          =>  "山恭製紙所",
                "kana"          =>  "ヤマキョウセイシジョ",
                "company_type"  =>  "株式会社_",
            ));

            KboxCompany::create(array(
                "category"      =>  "client",
                "code"          =>  "0101",
                "name"          =>  "浅野製作所",
                "kana"          =>  "アサノセイサクショ",
                "company_type"  =>  "株式会社_",
            ));

            KboxCompany::create(array(
                "category"      =>  "client",
                "code"          =>  "0102",
                "name"          =>  "安達鋼業",
                "kana"          =>  "アダチコウギョウ",
                "company_type"  =>  "_株式会社",
            ));
        }
    }
}