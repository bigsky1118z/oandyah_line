<?php

namespace Database\Seeders;

use App\Models\Webapp\CompanyProvideProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyProvideProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  1,
            "name"          =>  "弁当箱",
            'price'         =>  18,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  2,
            "name"          =>  null,
            'price'         =>  17,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  3,
            "name"          =>  null,
            'price'         =>  16,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  4,
            "name"          =>  null,
            'price'         =>  20,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  5,
            "name"          =>  null,
            'price'         =>  19,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  6,
            "name"          =>  null,
            'price'         =>  18,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  7,
            "name"          =>  null,
            'price'         =>  40,
            'quantity'      =>  1,
            "status"        =>  "セット",
            "delivery"      =>  "送付",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  1,
            "product_id"    =>  8,
            "name"          =>  null,
            'price'         =>  18,
            'quantity'      =>  1,
            "status"        =>  "セット",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  2,
            "product_id"    =>  1,
            "name"          =>  null,
            'price'         =>  18.5,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));

        CompanyProvideProduct::Create(array(
            "company_id"    =>  2,
            "product_id"    =>  3,
            "name"          =>  null,
            'price'         =>  17,
            'quantity'      =>  1,
            "status"        =>  "別々",
            "delivery"      =>  "配送",
            'leadtime'      =>  1,
            'start_date'    =>  date("Y-m-d H:i:s",mktime(0, 0, 0, 3, 1, 2023)),
            'end_date'      =>  null,
        ));


    }
}
