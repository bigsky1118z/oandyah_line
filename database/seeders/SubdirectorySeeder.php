<?php

namespace Database\Seeders;

use App\Models\User\Subdirectory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubdirectorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Subdirectory::$subdirectories as $subdirectory){
            Subdirectory::Create(array(
                "value"  =>  $subdirectory,
            ));
        }
    }
}
