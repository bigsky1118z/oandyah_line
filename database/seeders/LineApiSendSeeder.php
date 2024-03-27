<?php

namespace Database\Seeders;

use App\Models\Api\LineApiSend;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiSendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineApiSend::Create(array(
            "channel_name"  =>  "jinguji_ozora",
            "request_metod" =>  "post",
            "endpoint_type" =>  "push",
            "api_endpoint"  =>  "https://api.line.me/v2/bot/message/push",
            "status"    =>  "送信済み",
            "messages"  =>  null,
            "line_api_message_1_id" =>  1,
            "line_api_message_2_id" =>  1,
            "line_api_message_3_id" =>  2,
            "line_api_message_4_id" =>  null,
            "line_api_message_5_id" =>  null,
            "notification_disabled" =>  false,
            "to"    =>  "Ubaabca160ab17a89e7ede64cc084cbb5",
            "reply_token"   =>  null,
            "custom_aggregation_units"  =>  null,
            "recipient" =>  null,
            "filter"    =>  null,
            "limit" =>  null,
            "validate_status"   =>  200,
            "validate_error_message"    =>  null,
            "validate_error_details"    =>  null,
            "response_status"   =>  200,
            "request_id"    =>  null,
            "response_error_message"    =>  null,
            "response_error_details"    =>  null,
            "schedule_at"   =>  "2023-07-07",
            "sent_at"   =>  "2023-07-07",
        ));

    }
}
