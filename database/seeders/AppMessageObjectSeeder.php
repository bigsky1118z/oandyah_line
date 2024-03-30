<?php

namespace Database\Seeders;

use App\Models\App\AppMessageObject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppMessageObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppMessageObject::Create(array(
            "type"  =>  "text",
            "text"  =>  "しんしんに興味しんしん",
        ));
        AppMessageObject::Create(array(
            "type"  =>  "text",
            "text"  =>  "あざっく更新中",
        ));
    }
}
