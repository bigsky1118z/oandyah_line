<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\Line\Message\LineMessageImage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineMessageImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $line   =   Line::whereUserId($user->id)->whereName("jinguji_ozora")->first();
        LineMessageImage::Create(array(
            "line_id"               =>  $line->id,
            "status"                =>  "auto",
            "name"                  =>  "新澤菜央X",
            "original_content_url"  =>  "https://pbs.twimg.com/profile_images/1590272751981703169/0kHC2HI5_400x400.jpg",
            "preview_image_url"     =>  null,
        ));

    }
}
