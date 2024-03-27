<?php

namespace Database\Seeders;

use App\Models\Api\LineApiAttendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiAttendance::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "name"          =>  "同窓会",
            "section"       =>  null,
            "date"          =>  "2023-11-18",
            "open_time"     =>  "11:00:00",
            "start_time"    =>  "12:00:00",
            "end_time"      =>  "14:30:00",
            "close_time"    =>  "15:00:00",
            "place"         =>  "未定",
            "price"         =>  5000,
            "discription"   =>  "高津高校62期生3年8組の同窓会",
        ));

        LineApiAttendance::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "name"          =>  "同窓会",
            "section"       =>  "2次会",
            "date"          =>  "2023-11-18",
            "open_time"     =>  "16:00:00",
            "start_time"    =>  "16:30:00",
            "end_time"      =>  "20:00:00",
            "close_time"    =>  "20:30:00",
            "place"         =>  "未定",
            "price"         =>  5000,
            "discription"   =>  "高津高校62期生3年8組の同窓会の2次会です。",
        ));
    }
}
