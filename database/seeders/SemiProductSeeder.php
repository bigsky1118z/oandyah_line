<?php

namespace Database\Seeders;

use App\Models\Webapp\SemiProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemiProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SemiProduct::Create(array(
            'code'      =>  "0000101a",
            'company'   =>  "北角紙器",
            'name'      =>  "大凾",
            'color'     =>  "茶",
            'sheet'     =>  "KIボール",
            'gauge'     =>  8,
            'width'     =>  137,
            'length'    =>  110,
            'height'    =>  61,
            'semi_type'      =>  "C式[ミ]",
        ));

        SemiProduct::Create(array(
            'code'      =>  "0000101b",
            'company'   =>  "北角紙器",
            'name'      =>  "大凾",
            'color'     =>  "茶",
            'sheet'     =>  "KIボール",
            'gauge'     =>  8,
            'width'     =>  137,
            'length'    =>  110,
            'height'    =>  61,
            'semi_type'      =>  "C式[フタ]",
        ));        
    }
}
