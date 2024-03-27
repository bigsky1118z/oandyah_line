<?php

namespace Database\Seeders;

use App\Models\Website\WebsiteMembershipUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteMembershipUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteMembershipUser::Create(array(
            "website_membership_id" =>  2,
            "user_id"               =>  1,
        ));
        WebsiteMembershipUser::Create(array(
            "website_membership_id" =>  3,
            "user_id"               =>  1,
        ));
        WebsiteMembershipUser::Create(array(
            "website_membership_id" =>  3,
            "user_id"               =>  2,
        ));
    }
}
