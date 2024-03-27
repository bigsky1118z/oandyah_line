<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\Line\Message\LineMessageText;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineMessageTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $line   =   Line::whereUserId($user->id)->whereName("jinguji_ozora")->first();
        LineMessageText::Create(array(
            "line_id"   =>  $line->id,
            "status"    =>  "auto",
            "name"      =>  "メッセージ自動返答",
            "text"      =>  '${name}！メッセージありがとうございます！',
        ));
        LineMessageText::Create(array(
            "line_id"   =>  $line->id,
            "status"    =>  "auto",
            "name"      =>  "ポストバック自動返答",
            "text"      =>  "洗濯ありがとうございます！",
        ));
        LineMessageText::Create(array(
            "line_id"       =>  $line->id,
            "status"        =>  "draft",
            "name"          =>  "相談メッセージ（下書き）",
            "text"          =>  "どんなメッセージにしようかな？",
        ));

    }
}
