<?php

namespace Database\Seeders;

use App\Models\App\App;
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
            "birthday"          =>  mktime(0, 0, 0, 11, 18, 1991),
        ));
        $user->post_config("last_name","北角");
        $user->post_config("first_name","大空");
        $user->post_config("last_name_kana","キタズミ");
        $user->post_config("first_name_kana","ダイスケ");
        App::Create(array(
            "user_id"               =>  $user->id,
            "app_name"              =>  "first_app",            
            "channel_access_token"  =>  "46jMDeKXz36hFGeefYyNJ906lND6bcTmn3E9BXy2dO5qvj1BqUmsCKF79g44eFk+0LyRD75pNGCVWw3PkVm948DZMFEifDfld+fhFvta4eWCIxfEpaMj8dF4EdWk0aw66BWCFsVkpRJu8nrAhQKgaAdB04t89/1O/w1cDnyilFU=",
        ));


        $user   =   User::updateOrCreate(array(
            "email"             =>  "bigsky1118@gmail.com",
        ),array(
            "email_verified_at" =>  now(),
            "password"          =>  Hash::make("abc5news4-Z"),
            "user_name"         =>  "bigsky1118",
            "birthday"          =>  mktime(0, 0, 0, 11, 18, 1991),
        ));

        $user   =   User::updateOrCreate(array(
            "email"             =>  "jingujiozora@gmail.com",
        ),array(
            "email_verified_at" =>  now(),
            "password"          =>  Hash::make("abc5news4-Z"),
            "user_name"         =>  "jingujiozora",
            "birthday"          =>  mktime(0, 0, 0, 11, 18, 1991),
        ));

    }
}
