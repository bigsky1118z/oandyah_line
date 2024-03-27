<?php

namespace Database\Seeders;

use App\Models\Webapp\CompanyEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyEmail::create(array(
            "company_id"    =>  1,
            "email"         =>  "kitazumi@hakoyasan.com",
            "type"          =>  "代表",
        ));
    }
}
