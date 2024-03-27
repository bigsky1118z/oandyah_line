<?php

namespace Database\Seeders;

use App\Models\Webapp\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create(array(
            'code'      =>  '0000',
            'name'      =>  '北角紙器株式会社',
            'kana'      =>  'キタズミシキ',
            'tel'       =>  '06-6746-7944',
            'fax'       =>  '06-6746-8068',
            'cutoff'    =>  '99',
            'collect'   =>  '99',
            'is_write'  =>  'なし',
        ));

        Company::create(array(
            'code'      =>  '0101',
            'name'      =>  '株式会社浅野製作所',
            'kana'      =>  'アサノセイサクショ',
            'tel'       =>  '06-6568-2531',
            'fax'       =>  '06-6568-2533',
            'cutoff'    =>  '15',
            'collect'   =>  '7',
            'is_write'  =>  'なし',
        ));

        Company::create(array(
            'code'      =>  '0102',
            'name'      =>  '安達鋼業株式会社',
            'kana'      =>  'アダチコウギョウ',
            'tel'       =>  '072-985-8001',
            'fax'       =>  '072-987-5230',
            'cutoff'    =>  '20',
            'collect'   =>  '10',
            'is_write'  =>  '単価のみ',
        ));
    }
}
