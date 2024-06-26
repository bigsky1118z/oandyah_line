<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\UserApp;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereName("bigsky1118z")->first();
        UserApp::updateOrCreate(array(
            "user_id"   =>  $user->id,
            "app_id"    =>  App::where("client_id","1657423958")->first()->id,
        ),array(
            "role"      =>  "admin",
        ));
        UserApp::updateOrCreate(array(
            "user_id"   =>  $user->id,
            "app_id"    =>  App::where("client_id","1657119748")->first()->id,
        ),array(
            "role"      =>  "admin",
        ));
    }
}
