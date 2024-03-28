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
