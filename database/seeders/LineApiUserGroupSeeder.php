<?php

namespace Database\Seeders;

use App\Models\Api\LineApiUserGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiUserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiUserGroup::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "name"          =>  "管理者",
            "description"   =>  "このチャンネルの管理者権限を有する人のグループ",
            "active"        =>  true,
            "rank"          =>  null,
        ));

        LineApiUserGroup::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "name"          =>  "管理者",
            "description"   =>  "このチャンネルの占い師のグループ",
            "active"        =>  true,
            "rank"          =>  null,
        ));
    }
}
