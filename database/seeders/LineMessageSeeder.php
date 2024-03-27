<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\Line\LineMessage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $line   =   Line::whereUserId($user->id)->whereName("jinguji_ozora")->first();
        if($line){
            $message    =   LineMessage::Create(array(
                "line_id"                   =>  $line->id,
                "type"                      =>  "push",
                "line_user_id"              =>  "Ubaabca160ab17a89e7ede64cc084cbb5",
                "status"                    =>  "draft",
                "custom_aggregation_units"  =>  "message_" . date("YmdHis"),
            ));
            $message->set_message_object_by_name(1,"text","メッセージ自動返答");
            $message->set_message_object_by_name(2,"text","ポストバック自動返答");
            $message->set_message_object_by_name(3,"text","相談メッセージ（下書き）");
            $message->set_message_object_by_name(2,"location","NMB48劇場");
            $message->set_message_object_by_name(4,"image","新澤菜央X");

        }


    }
}
