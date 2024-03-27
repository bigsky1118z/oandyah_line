<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\Line\Message\LineMessageLocation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineMessageLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $line   =   Line::whereUserId($user->id)->whereName("jinguji_ozora")->first();
        LineMessageLocation::Create(array(
            "line_id"   =>  $line->id,
            "status"    =>  "auto",
            "name"      =>  "NMB48劇場",
            "title"     =>  "NMB48劇場",
            "address"   =>  "〒542-0075 大阪府大阪市中央区難波千日前12-7 Yes・NambaビルB1F",
            "latitude"  =>  34.66464301582506,
            "longitude" =>  135.50309826879553,
        ));
    }
}
