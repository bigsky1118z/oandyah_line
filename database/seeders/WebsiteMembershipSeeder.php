<?php

namespace Database\Seeders;

use App\Models\Website\WebsiteMembership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteMembership::Create(array(
            "name"          =>  "ユーザー登録",
            "grade"         =>  null,
            "discription"   =>  null,
        ));

        WebsiteMembership::Create(array(
            "name"          =>  "管理者",
            "grade"         =>  null,
            "discription"   =>  null,
        ));

        WebsiteMembership::Create(array(
            "name"          =>  "編集者",
            "grade"         =>  null,
            "discription"   =>  null,
        ));

        WebsiteMembership::Create(array(
            "name"          =>  "閲覧者",
            "grade"         =>  null,
            "discription"   =>  null,
        ));
    }
}
