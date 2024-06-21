<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channels   =   array(
            array(
                "client_id"             =>  "1657423958",
                "channel_access_token"  =>  "46jMDeKXz36hFGeefYyNJ906lND6bcTmn3E9BXy2dO5qvj1BqUmsCKF79g44eFk+0LyRD75pNGCVWw3PkVm948DZMFEifDfld+fhFvta4eWCIxfEpaMj8dF4EdWk0aw66BWCFsVkpRJu8nrAhQKgaAdB04t89/1O/w1cDnyilFU=",
                "channel_secret"        =>  "56b17adcc98c321d8f7fbaca5235ea55",
            ),
            array(            
                "client_id"             =>  "1657119748",
                "channel_access_token"  =>  "DevGS+xmzvpISz1LGy8LxAnjxCY15MFSXRljWAXFXvgJDkWVshk+96bkn4JIPaaB0s+2xKTuJbYlch10BctkIjTHIwEPcCirPr5S1JFgfQgf9MaMQb2YQowhEBGT5eBkVHIDCAeddeimB03lpslywAdB04t89/1O/w1cDnyilFU=",
                "channel_secret"        =>  "998481f4b73c4e7a6785d9158e798e58",
            ),
        );

        foreach($channels as $channel){
            $app    =   App::create_app($channel["channel_access_token"],$channel["channel_secret"]);
        }
    }
}
