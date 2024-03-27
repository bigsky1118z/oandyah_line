<?php

namespace Database\Seeders;

use App\Models\Api\LineApiUserUserGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiUserUserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiUserUserGroup::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_user_group_id"    =>  1,
            "line_api_user_id"          =>  1,
        ));

        LineApiUserUserGroup::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_user_group_id"    =>  1,
            "line_api_user_id"          =>  2,
        ));

        LineApiUserUserGroup::Create(array(
            "channel_name"              =>  "jinguji_ozora",
            "line_api_user_group_id"    =>  2,
            "line_api_user_id"          =>  1,
        ));
    }
}
