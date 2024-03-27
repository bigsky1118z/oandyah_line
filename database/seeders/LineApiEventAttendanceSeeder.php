<?php

namespace Database\Seeders;

use App\Models\Api\LineApiEventAttendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiEventAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiEventAttendance::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "line_api_event_id" =>  1,
            "line_api_user_id"  =>  1,
            "value"             =>  "出席",
            "status"            =>  "入金済",
        ));

        LineApiEventAttendance::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "line_api_event_id" =>  1,
            "line_api_user_id"  =>  2,
            "value"             =>  "欠席",
            "status"            =>  null,
        ));

        LineApiEventAttendance::Create(array(
            "channel_name"      =>  "jinguji_ozora",
            "line_api_event_id" =>  2,
            "line_api_user_id"  =>  1,
            "value"             =>  "出席",
            "status"            =>  "未入金",
        ));

    }
}
