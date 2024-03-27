<?php

namespace Database\Seeders;

use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Product\KboxProduct;
use App\Models\Kbox\Sheet\KboxSheet;
use App\Models\Kbox\Sheet\KboxSheetGram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KboxProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv    =   Storage::disk("kbox")->get("product/kbox_products.csv");
        if($csv){
            $kbox_products =   array();
            foreach(explode(PHP_EOL, $csv) as $line){
                $line ? $kbox_products[] = str_getcsv($line) : null;
            }
            $headers    =   array_shift($kbox_products);
            foreach($kbox_products as $kbox_product){
                if(count($headers) == count($kbox_product)){
                    $kbox_company   =   KboxCompany::whereName($kbox_product[array_search("kbox_company", $headers)])->first();
                    $sheet          =   KboxSheet::whereName($kbox_product[array_search("sheet", $headers)])->first();
                    if($sheet){
                        $sheet_gram =   KboxSheetGram::whereKboxSheetId($sheet->id)->whereGram($kbox_product[array_search("gram", $headers)])->first();
                    }
                    KboxProduct::updateOrCreate(array(
                        "code"                  =>  $kbox_product[array_search("code", $headers)] ? $kbox_product[array_search("code", $headers)] : null,
                        "type"                  =>  $kbox_product[array_search("type", $headers)] ? $kbox_product[array_search("type", $headers)] : null,
                        "kbox_company_id"       =>  isset($kbox_company->id) ? $kbox_company->id : null,
                        "name"                  =>  $kbox_product[array_search("name", $headers)] ? $kbox_product[array_search("name", $headers)] : null,
                        "classification"        =>  $kbox_product[array_search("classification", $headers)] ? $kbox_product[array_search("classification", $headers)] : null,
                        "extra"                 =>  $kbox_product[array_search("extra", $headers)] ? $kbox_product[array_search("extra", $headers)] : null,
                        "color"                 =>  $kbox_product[array_search("color", $headers)] ? $kbox_product[array_search("color", $headers)] : null,
                        "description"           =>  $kbox_product[array_search("description", $headers)] ? $kbox_product[array_search("description", $headers)] : null,
                        "kbox_sheet_gram_id"    =>  isset($sheet->id) && isset($sheet_gram->id) ? $sheet_gram->id : null,
                        "length"                =>  $kbox_product[array_search("length", $headers)] ? $kbox_product[array_search("length", $headers)] : null,
                        "width"                 =>  $kbox_product[array_search("width", $headers)] ? $kbox_product[array_search("width", $headers)] : null,
                        "height"                =>  $kbox_product[array_search("height", $headers)] ? $kbox_product[array_search("height", $headers)] : null,
                        "low_top"               =>  $kbox_product[array_search("low_top", $headers)] ? $kbox_product[array_search("low_top", $headers)] : null,
                        "assemble"              =>  $kbox_product[array_search("assemble", $headers)] ? $kbox_product[array_search("assemble", $headers)] : null,
                        "cutting"               =>  $kbox_product[array_search("cutting", $headers)] ? $kbox_product[array_search("cutting", $headers)] : null,
                        "processing"            =>  $kbox_product[array_search("processing", $headers)] ? $kbox_product[array_search("processing", $headers)] : null,
                    ));
                }
            }
        } else {
            KboxProduct::Create(array(
                "code"                  =>  "0000101",
                "type"                  =>  "C式",
                
                "kbox_company_id"       =>  KboxCompany::whereName("北角紙器")->first()->id,
                "name"                  =>  "大凾",
                "classification"        =>  null,
                "extra"                 =>  null,
                "color"                 =>  "無地",
                
                "description"           =>  null,
                
                "kbox_sheet_gram_id"    =>  KboxSheetGram::whereKboxSheetId(KboxSheet::whereName("KIボール")->first()->id)->whereGram(420)->first()->id,
                
                "length"                =>  137,
                "width"                 =>  110,
                "height"                =>  61,
                "low_top"               =>  null,
                
                "assemble"              =>  "自社",
                "cutting"               =>  "自社",
                "processing"            =>  null,
            ));

            KboxProduct::Create(array(
                "code"                  =>  "0000301",
                "type"                  =>  "C式",
                
                "kbox_company_id"       =>  KboxCompany::whereName("北角紙器")->first()->id,
                "name"                  =>  "大凾",
                "classification"        =>  null,
                "extra"                 =>  null,
                "color"                 =>  "無地",
                
                "description"           =>  null,
                
                "kbox_sheet_gram_id"    =>  KboxSheetGram::whereKboxSheetId(KboxSheet::whereName("山一Aクラフト")->first()->id)->whereGram(450)->first()->id,
                
                "length"                =>  137,
                "width"                 =>  110,
                "height"                =>  61,
                "low_top"               =>  null,
                
                "assemble"              =>  "自社",
                "cutting"               =>  "自社",
                "processing"            =>  null,
            ));
            
            KboxProduct::Create(array(
                "code"                  =>  "2105201",
                "type"                  =>  "C式",
                
                "kbox_company_id"       =>  KboxCompany::whereName("北角紙器")->first()->id,
                "name"                  =>  "大凾",
                "classification"        =>  "サンコーインダストリー",
                "extra"                 =>  null,
                "color"                 =>  "印刷",
                
                "description"           =>  null,
                
                "kbox_sheet_gram_id"    =>  KboxSheetGram::whereKboxSheetId(KboxSheet::whereName("KIボール")->first()->id)->whereGram(420)->first()->id,
                
                "length"                =>  137,
                "width"                 =>  110,
                "height"                =>  61,
                "low_top"               =>  null,
                
                "assemble"              =>  "自社",
                "cutting"               =>  "自社",
                "processing"            =>  "森川",
            ));
        }
        

    }
}
