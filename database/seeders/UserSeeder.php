<?php

namespace Database\Seeders;

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
            "user_name"         =>  "bigsky1118z",
        ));
        $user->post_config("last_name","北角");
        $user->post_config("first_name","大空");
        $user->post_config("last_name_kana","キタズミ");
        $user->post_config("first_name_kana","ダイスケ");

        // $configs    =   array(
        //     "last_name"         =>  "北角",
        //     "first_name"        =>  "大空",
        //     "last_name_kana"    =>  "キタズミ",
        //     "first_name_kana"   =>  "ダイスケ",
        // );
        // foreach($configs as $key => $value){
        //     $user->post_config($key,$value);
        // }

        $user   =   User::updateOrCreate(array(
            "email"             =>  "bigsky1118@gmail.com",
        ),array(
            "email_verified_at" =>  now(),
            "password"          =>  Hash::make("abc5news4-Z"),
            "user_name"         =>  "bigsky1118",
        ));

        $user   =   User::updateOrCreate(array(
            "email"             =>  "jingujiozora@gmail.com",
        ),array(
            "email_verified_at" =>  now(),
            "password"          =>  Hash::make("abc5news4-Z"),
            "user_name"         =>  "jingujiozora",
        ));

    }
}
