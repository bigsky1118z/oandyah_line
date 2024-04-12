<?php

namespace Database\Seeders;

use App\Models\App;
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
        $app        =   App::whereName("gluten_free")->first();
        $message    =   AppMessage::Create(array(
            "app_id"    =>  $app->id,
            "status"    =>  "draft",
            "messages"  =>  array(
                array(
                    "type"  =>  "text",
                    "text"  =>  "新澤菜央様",
                ),
            ),
        ));

    }
}
