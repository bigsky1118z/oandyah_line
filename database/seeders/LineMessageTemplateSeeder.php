<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineMessageTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $line   =   Line::whereUserId($user->id)->whereName("jinguji_ozora")->first();
    }
}
