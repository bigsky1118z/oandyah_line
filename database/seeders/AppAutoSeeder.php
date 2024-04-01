<?php

namespace Database\Seeders;

use App\Models\App\AppAuto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppAutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppAuto::udateOrCreate(array(
            "status"    =>  "random",
            "type"      =>  "message",
            "condition" =>  "partial",
            "trigger"   =>  "",
            "priority"  =>  1,
        ));
    }
}
