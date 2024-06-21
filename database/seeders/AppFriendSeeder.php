<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppFriend;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppFriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app    =   App::where("client_id","1657119748")->first();
        $friend =   AppFriend::updateOrCreate(array(

        ));
    }
}
