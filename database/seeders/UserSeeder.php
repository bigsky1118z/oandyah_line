<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::updateOrCreate(array(
            "email"             =>  "bigsky1118z@gmail.com",
        ),array(
            "email_verified_at" =>  now(),
            "password"          =>  Hash::make("abc5news4-Z"),
            "name"              =>  "bigsky1118z",
            "birthday"          =>  mktime(0, 0, 0, 11, 18, 1991),
        ));
        $user->post_config("last_name","神宮寺");
        $user->post_config("first_name","大空");
        $user->post_config("last_name_kana","キタズミ");
        $user->post_config("first_name_kana","オオゾラ");


        $user   =   User::updateOrCreate(array(
            "email"             =>  "bigsky1118@gmail.com",
        ),array(
            "email_verified_at" =>  now(),
            "password"          =>  Hash::make("abc5news4-Z"),
            "name"              =>  "bigsky1118",
            "birthday"          =>  mktime(0, 0, 0, 11, 18, 1991),
        ));
        $user->post_config("last_name","北角");
        $user->post_config("first_name","大空");
        $user->post_config("last_name_kana","キタズミ");
        $user->post_config("first_name_kana","ダイスケ");
    }
}
