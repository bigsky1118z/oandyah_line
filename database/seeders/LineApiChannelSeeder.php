<?php

namespace Database\Seeders;

use App\Models\Api\LineApiChannel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineApiChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $line_api_channel   =   LineApiChannel::Create(array(
            "user_id"       =>  1,
            "channel_name"  =>  "jinguji_ozora",
            "access_token"  =>  "DevGS+xmzvpISz1LGy8LxAnjxCY15MFSXRljWAXFXvgJDkWVshk+96bkn4JIPaaB0s+2xKTuJbYlch10BctkIjTHIwEPcCirPr5S1JFgfQgf9MaMQb2YQowhEBGT5eBkVHIDCAeddeimB03lpslywAdB04t89/1O/w1cDnyilFU=",
        ));
        $line_api_channel->update_info();
        $line_api_channel->create_defaults();


        $line_api_channel   =   LineApiChannel::Create(array(
            "user_id"       =>  1,
            "channel_name"  =>  "kitazumi",
            "access_token"  =>  "Iz+OztUfZslSbcFq+PEU63lli4QXNE47Q5kSv0rYacTfLaknN8kYBXL8+YhBg5FD7VrAeUziLIqA9RFnzFE90WCIOaUXJAa9g+5zjSLTpnxZ6HNY18VbKEmT8zSVJSm0lq0wtQw/OYtuG6xnsqdrwAdB04t89/1O/w1cDnyilFU=",
        ));
        $line_api_channel->update_info();
        $line_api_channel->create_defaults();

        $line_api_channel   =   LineApiChannel::Create(array(
            "user_id"       =>  1,
            "channel_name"  =>  "kozu-62-3-8",
            "access_token"  =>  "qfKV2t84+Nc9pvnS/y5thZdUdZ2/5RW9sOxd7VTo2d8YKGFzolxYeGwrlqnugJJvMP2M6n8ybPj9RnseERjd8epX0tNpRtZ+uy0i09Ydgy30e1TCQ94TPXDXU1WeXcxRtGUuoMO/V/rCVUI7JfuGuQdB04t89/1O/w1cDnyilFU=",
        ));
        $line_api_channel->update_info();
        $line_api_channel->create_defaults();


        $line_api_channel   =   LineApiChannel::Create(array(
            "user_id"       =>  1,
            "channel_name"  =>  "groovy_cruise_1",
            "access_token"  =>  "K9Tv6atl0R39k1kLLDRiKP/ugg5xUUvbJr1I0T9AbKSR3vYCsbjPZe6fDuiZ5pTKyMnSR8w3bSSACGor2l10KpC1aDoaZs+FctIV0fuig7kyesT2GcZ3OA/iUw/yKS5mvFVj3LYWlnMUIKAc6yAeuQdB04t89/1O/w1cDnyilFU=",
        ));
        $line_api_channel->update_info();
        $line_api_channel->create_defaults();

        $line_api_channel   =   LineApiChannel::Create(array(
            "user_id"       =>  1,
            "channel_name"  =>  "groovy_cruise_2",
            "access_token"  =>  "XiPwKbnoFH/T2RbUDxzh4BStdgd6DbVoCRxsfnvwOjYqi+4zr9OsZ+3G8hTjYZHYrERFTAMl1oQobci0RJXhkdB8UvQEydiZEj9Dm3eZEaiIbwIA8t347sMs5Ya+/vaqAFl8oiSNJvYjuS8lsL6pLgdB04t89/1O/w1cDnyilFU=",
        ));
        $line_api_channel->update_info();
        $line_api_channel->create_defaults();

    }   
}
