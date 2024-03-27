<?php

namespace Database\Seeders;

use App\Models\User\UserCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCompany::create(array(
            "user_id"       =>  1,
            "company_id"    =>  1,
        ));

        UserCompany::create(array(
            "user_id"       =>  1,
            "company_id"    =>  2,
        ));

        UserCompany::create(array(
            "user_id"       =>  2,
            "company_id"    =>  1,
        ));
    }
}
