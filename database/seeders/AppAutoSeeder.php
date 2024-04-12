<?php

namespace Database\Seeders;

use App\Models\App;
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
        AppAuto::updateOrCreate(array(
            "app_id"    =>  App::whereName("gluten_free")->first()->id,
        ),array(
            "type"              =>  "message",
            "condition"         =>  array(
                "match" =>  "exact_match",
                "word"  =>  "はい",
            ),
            "priority"          =>  1,
            "app_message_id"    =>  1,
        ));
    }
}
