<?php

namespace Database\Seeders;

use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Sheet\KboxSheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KboxSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "KIボール",
            "color"                     =>  "茶",
            "supplier_id"               =>  KboxCompany::whereName("伊藤忠紙パルプ商事")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("大和板紙")->first()->id,
        ));
        $sheet->set_price(133, 150, 152, "2023-03-01");

        $sheet_gram =   $sheet->set_gram(400);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(820, 1120);        
        $sheet_gram =   $sheet->set_gram(410);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(785, 715);
        $sheet_gram =   $sheet->set_gram(420);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(810, 655);
            $sheet_gram->set_size(730, 750);
            $sheet_gram->set_size(925, 600);
            $sheet_gram->set_size(600, 925);
        $sheet_gram =   $sheet->set_gram(470);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(805, 665);
            $sheet_gram->set_size(815, 665);
            $sheet_gram->set_size(805, 625);
            $sheet_gram->set_size(880, 560);
            $sheet_gram->set_size(805, 720);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "特クラフト",
            "color"                     =>  "黄",
            "supplier_id"               =>  KboxCompany::whereName("伊藤忠紙パルプ商事")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("大和板紙")->first()->id,
        ));
        $sheet->set_price(136, 150, 152, "2023-03-01");

        $sheet_gram =   $sheet->set_gram(350);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(500, 730);
        $sheet_gram =   $sheet->set_gram(400);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(500, 835);
        $sheet_gram =   $sheet->set_gram(450);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(745, 590);
            $sheet_gram->set_size(730, 705);
            $sheet_gram->set_size(795, 590);
        $sheet_gram =   $sheet->set_gram(500);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(750, 710);
            $sheet_gram->set_size(750, 580);
            $sheet_gram->set_size(800, 590);
            $sheet_gram->set_size(840, 640);
            $sheet_gram->set_size(830, 680);
            $sheet_gram->set_size(920, 625);
            $sheet_gram->set_size(770, 560);
            $sheet_gram->set_size(870, 620);
        $sheet_gram =   $sheet->set_gram(550);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "RKクラフト",
            "color"                     =>  "黄",
            "supplier_id"               =>  KboxCompany::whereName("七條紙商事")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("山恭製紙所")->first()->id,
        ));
        $sheet->set_price(null, null, null, "2023-03-01");

        $sheet_gram =   $sheet->set_gram(450);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(500, 800);
            $sheet_gram->set_size(530, 850);
            $sheet_gram->set_size(560, 920);
            $sheet_gram->set_size(880, 560);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "山一Aクラフト",
            "color"                     =>  "黄",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));

        $sheet->set_price(149, 165, 172, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(450);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(500, 800);
            $sheet_gram->set_size(785, 715);
            $sheet_gram->set_size(925, 600);
            $sheet_gram->set_size(520, 880);
        $sheet_gram =   $sheet->set_gram(500);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(570, 750);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "KSクラフト",
            "color"                     =>  "黄",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));
        $sheet->set_price(149, 165, 172, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(450);
            $sheet_gram->set_size(800, 1100);
            $sheet_gram->set_size(550, 880);
            $sheet_gram->set_size(605, 760);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "サンイタシルク",
            "color"                     =>  "白",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));
        $sheet->set_price(161, null, 175, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(400);
            $sheet_gram->set_size(800, 1100);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "シラギクゼロ",
            "color"                     =>  "白",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));
        $sheet->set_price(null, null, null, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(400);
            $sheet_gram->set_size(800, 1100);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "サンコート",
            "color"                     =>  "白",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));
        $sheet->set_price(null, null, null, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(600);
            $sheet_gram->set_size(800, 1100);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "コートボール",
            "color"                     =>  "白",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));
        $sheet->set_price(146, 155, 159, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(400);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(450);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(500);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(550);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(600);
            $sheet_gram->set_size(800, 1100);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "白菊",
            "color"                     =>  "白",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));
        $sheet->set_price(173, 185, 187, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(500);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(450);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(550);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(600);
            $sheet_gram->set_size(800, 1100);

        $sheet  =   KboxSheet::create(array(
            "name"                      =>  "チップボール",
            "color"                     =>  "グレー",
            "supplier_id"               =>  KboxCompany::whereName("オービシ")->first()->id,
            "manufacturer_id"           =>  KboxCompany::whereName("加賀製紙")->first()->id,
        ));
        $sheet->set_price(161, 170, 172, "2023-03-01");
        $sheet_gram =   $sheet->set_gram(450);
            $sheet_gram->set_size(800, 1100);
        $sheet_gram =   $sheet->set_gram(550);
            $sheet_gram->set_size(800, 1100);
    }
}
