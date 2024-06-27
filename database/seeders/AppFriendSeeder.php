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
        $app        =   App::where("client_id","1657423958")->first();
        $friend_ids =   array(
            "Ubaabca160ab17a89e7ede64cc084cbb5",
            "U50a281d4dc4df0b5fb8158daf7eaf213",
        );
        foreach($friend_ids as $friend_id){
            $friend =   AppFriend::updateOrCreate(array(
                "app_id"    =>  $app->id,
                "friend_id" =>  $friend_id,
            ));
            $friend->latest();
        }
    }
}
