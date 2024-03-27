<?php

namespace Database\Seeders;

use App\Models\Webapp\ProductSemiProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSemiProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductSemiProduct::Create(array(
            "product_id"    =>  1,
            "semi_product_id"    =>  1,
        ));

        ProductSemiProduct::Create(array(
            "product_id"    =>  1,
            "semi_product_id"    =>  2,
        ));
    }
}
