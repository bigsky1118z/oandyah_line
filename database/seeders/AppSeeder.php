<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        App::updateOrCreate(array(
            "name"                  =>  "gluten_free",
        ),array(            
            "channel_access_token"  =>  "46jMDeKXz36hFGeefYyNJ906lND6bcTmn3E9BXy2dO5qvj1BqUmsCKF79g44eFk+0LyRD75pNGCVWw3PkVm948DZMFEifDfld+fhFvta4eWCIxfEpaMj8dF4EdWk0aw66BWCFsVkpRJu8nrAhQKgaAdB04t89/1O/w1cDnyilFU=",
        ));
    }
}
