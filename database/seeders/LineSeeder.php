<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        
        $line   =   Line::updateOrCreate(array(
            "user_id"               =>  $user ? $user->id : 1,
            "name"                  =>  "jinguji_ozora",
            "channel_access_token"  =>  "DevGS+xmzvpISz1LGy8LxAnjxCY15MFSXRljWAXFXvgJDkWVshk+96bkn4JIPaaB0s+2xKTuJbYlch10BctkIjTHIwEPcCirPr5S1JFgfQgf9MaMQb2YQowhEBGT5eBkVHIDCAeddeimB03lpslywAdB04t89/1O/w1cDnyilFU=",
        ));
        $line->put_bot_channel_webhook_endpoint();
        $line->get_bot_info();

        $line   =   Line::updateOrCreate(array(
            "user_id"               =>  $user ? $user->id : 1,
            "name"                  =>  "kozu620308",
            "channel_access_token"  =>  "qfKV2t84+Nc9pvnS/y5thZdUdZ2/5RW9sOxd7VTo2d8YKGFzolxYeGwrlqnugJJvMP2M6n8ybPj9RnseERjd8epX0tNpRtZ+uy0i09Ydgy30e1TCQ94TPXDXU1WeXcxRtGUuoMO/V/rCVUI7JfuGuQdB04t89/1O/w1cDnyilFU=",
        ));
        $line->put_bot_channel_webhook_endpoint();
        $line->get_bot_info();

    }
}
