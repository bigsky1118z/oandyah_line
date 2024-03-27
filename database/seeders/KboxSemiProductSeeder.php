<?php

namespace Database\Seeders;

use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Product\KboxSemiProduct;
use App\Models\Kbox\Sheet\KboxSheet;
use App\Models\Kbox\Sheet\KboxSheetGram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KboxSemiProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KboxSemiProduct::Create(array(
            "code"                  =>  "0000101b",
            "part"                  =>  "身",

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

            "processing"            =>  null,
        ));

        KboxSemiProduct::Create(array(
            "code"                  =>  "0000101t",
            "part"                  =>  "蓋",

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

            "processing"            =>  null,
        ));

        KboxSemiProduct::Create(array(
            "code"                  =>  "2105201t",
            "part"                  =>  "蓋",

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

            "processing"            =>  "森川",
        ));
    }
}
