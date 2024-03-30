<?php

namespace Database\Seeders;

use App\Models\App\AppMessage;
use App\Models\App\AppMessageObject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $message    =   AppMessage::Create(array(

        ));
        $message_object_1   =   AppMessageObject::Create(array(
            "type"  =>  "text",
            "text"  =>  "しんしんに興味しんしん",
        ));
        $message_object_2   =   AppMessageObject::Create(array(
            "type"  =>  "text",
            "text"  =>  "あざっく更新中",
        ));
        $message->app_message_object_1_id   =   $message_object_1->id;
        $message->app_message_object_2_id   =   $message_object_2->id;
        $message->app_message_object_3_id   =   $message_object_1->id;
        $message->app_message_object_4_id   =   $message_object_2->id;
        $message->app_message_object_5_id   =   $message_object_2->id;
        $message->save();

    }
}
