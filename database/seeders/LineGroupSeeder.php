<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\Line\LineGroup;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $line   =   Line::whereUserId($user->id)->whereName("kozu620308")->first();
        if($line){
            LineGroup::updateOrCreate(array(
                "line_id"       =>  $line->id,
                "name"          =>  "boy",
                "title"         =>  "ボーイズ",
                "description"   =>  "男性のみのグループ",
            ));
            LineGroup::updateOrCreate(array(
                "line_id"       =>  $line->id,
                "name"          =>  "girl",
                "title"         =>  "ガールズ",
                "description"   =>  "女性のみのグループ",
            ));
            LineGroup::updateOrCreate(array(
                "line_id"       =>  $line->id,
                "name"          =>  "organizer",
                "title"         =>  "幹事",
                "description"   =>  "同窓会幹事のグループ",
            ));
        }
    }
}
