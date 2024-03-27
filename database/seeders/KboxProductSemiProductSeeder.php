<?php

namespace Database\Seeders;

use App\Models\Kbox\Product\KboxProduct;
use App\Models\Kbox\Product\KboxProductSemiProduct;
use App\Models\Kbox\Product\KboxSemiProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KboxProductSemiProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KboxProductSemiProduct::Create(array(
            "kbox_product_id"   =>  KboxProduct::whereCode("0000101")->first()->id,
            "top_id"            =>  KboxSemiProduct::whereCode("0000101t")->first()->id,
            "bottom_id"         =>  KboxSemiProduct::whereCode("0000101b")->first()->id,
        ));

        KboxProductSemiProduct::Create(array(
            "kbox_product_id"   =>  KboxProduct::whereCode("2105201")->first()->id,
            "top_id"            =>  KboxSemiProduct::whereCode("2105201t")->first()->id,
            "bottom_id"         =>  KboxSemiProduct::whereCode("0000101b")->first()->id,
        ));
    }
}
