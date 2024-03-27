<?php

namespace Database\Seeders;

use App\Models\Website\WebsiteConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(WebsiteConfig::$defaults as $name => $value){
            WebsiteConfig::updateOrCreate(array(
                "name"  =>  $name,
            ),array(
                "value" =>  $value,
            ));
        }
    }
}
