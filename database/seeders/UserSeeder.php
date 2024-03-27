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
    public function run()
    {
        $user   =   User::create(array(
            "email"             =>  "bigsky1118@gmail.com",
            "email_verified_at" =>  date("Y-m-d H:i:s"),
            "password"          =>  Hash::make("abc5news4-Z"),
        ));
        $user->set_birthday(1991,11,18,15,25,"大阪府");
        $user->set_name("jp","北角","大空");
        $user->set_name("kana","きたずみ","だいすけ");
        $user->set_name("en","Kitazumi","Daisuke");
        $user->set_name("nickname","おおぞら");
        $user->set_name("naming","本人");
        $user->set_name("honorific_title","さま");

        $user   =   User::create(array(
            "email"             =>  "bigsky1118z@gmail.com",
            "email_verified_at" =>  date("Y-m-d H:i:s"),
            "password"          =>  Hash::make("abc5news4-Z"),
        ));
        $user->set_birthday(1991,11,18,15,25,"大阪府");
        $user->set_name("jp","神宮寺","大空");
        $user->set_name("kana","じんぐうじ","おおぞら");
        $user->set_name("en","Jinguji","Ozora");

        $user   =   User::create(array(
            "email"             =>  "daicekbox@gmail.com",
            "email_verified_at" =>  date("Y-m-d H:i:s"),
            "password"          =>  Hash::make("abc5news4-Z"),
        ));
        $user->set_birthday(null,null,null,null,null,null);
        $user->set_name("jp",null,"大空");
        $user->set_name("kana",null,"だいすけ");
        $user->set_name("en",null,"daisuke");

    }
}
