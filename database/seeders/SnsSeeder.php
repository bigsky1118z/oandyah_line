<?php

namespace Database\Seeders;

use App\Models\Sns\Sns;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $sns    =   Sns::updateOrCreate(array(
            "user_id"       =>  $user ? $user->id : 1,
            "name"          =>  "bigsky1118",
            "title"         =>  "大空",
            "description"   =>  "私のSNSです。",
        ));
        $sns->set_config("type", "list");



        $sns    =   Sns::updateOrCreate(array(
            "user_id"       =>  $user ? $user->id : 1,
            "name"          =>  "jinguji_ozora",
            "title"         =>  "神宮寺大空",
            "description"   =>  "占い師 神宮寺大空のSNSリンク集です",
        ));
        $sns->set_config("type", "list");

        $sns    =   Sns::updateOrCreate(array(
            "user_id"       =>  $user ? $user->id : 1,
            "name"          =>  "shinzawa_nao",
            "title"         =>  "新澤菜央",
            "description"   =>  "NMB48 新澤菜央さんの公式アカウントのリンク集です",
        ));
        $sns->set_config("type", "list");


    }
}
