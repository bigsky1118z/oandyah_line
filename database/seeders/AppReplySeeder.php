<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppReply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app            =   App::where("client_id","1657423958")->first();
        $app_Reply      =   AppReply::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "type"      =>  "follow",
            "match"     =>  null,
            "keyword"   =>  array(),
            "status"    =>  "active",
        ));
        $app_Reply      =   AppReply::updateOrCreate(array(
            "app_id"    =>  $app->id,
            "type"      =>  "message",
            "match"     =>  "partial",
            "keyword"   =>  array("はじめまして","こんにちは","さようなら"),
            "status"    =>  "active",
        ));
    }
}
