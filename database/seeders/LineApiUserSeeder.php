<?php

namespace Database\Seeders;

use App\Models\Api\LineApiUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $line_api_user = LineApiUser::Create(array(
            'channel_name'      =>  "jinguji_ozora",
            "line_user_id"      =>  "Ubaabca160ab17a89e7ede64cc084cbb5",
            'registed_name'     =>  "神宮寺大空",
            'honorific'         =>  'Mr.',
            "name_to_identify"  =>  "北角大空",
            "memo"              =>  "管理人",
        ));
        $line_api_user->get_present_profile();

        $line_api_user = LineApiUser::Create(array(
            'channel_name'      =>  "jinguji_ozora",
            "line_user_id"      =>  "U50a281d4dc4df0b5fb8158daf7eaf213",
            'registed_name'     =>  null,
            'honorific'         =>  'さん',
            "name_to_identify"  =>  "北角由香里",
            "memo"              =>  "副管理人",
        ));
        $line_api_user->get_present_profile();        

    }
}
