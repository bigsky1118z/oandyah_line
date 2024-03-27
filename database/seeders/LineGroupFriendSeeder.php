<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\Line\LineFriend;
use App\Models\Line\LineGroup;
use App\Models\Line\LineGroupFriend;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineGroupFriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        if($user){
            $line   =   Line::whereUserId($user->id)->whereName("kozu620308")->first();
            if($line){
                $line_group_user_ids  =   array(
                    "boy"       =>  array(
                        "U39ed56fcdfd58cfaf46e197d4cbe875d",
                        "Udb8681f21c789f06515d8926670b503d",
                        "Uf3a43378e9e592437b525e0ef93ecb87",
                        "U2db53d518e8622eb5f31fee993fcca72",
                        "U9040c3e285e2d2603c132c25375822d0",
                        "U93a1324cd5e786bc0df0a1d7af723437",
                        "U0433d6bb8aa9ba6b9f0b5afa24c82c51",
                        "Ufde57df893fcba5616d00c7bb6b6b0d9",
                        "Uac030c2045c2f9dc89372d3927fbcbb4",
                        "Ufd6480639a391948569b1ece4334075b",
                        "Udd45daf18f379415b3e480f208fbf074",
                        "U0a1cb75227b3039f509ae2434413d04b",
                        "Uc5e122a22edf0effe8208fb7e400c272",
                        "U6a5431136e575d2073f68d278e5f81d4",
                        "U6d1726d30ceddd0d39bbb910c12125b6",
                        "U9fef19d6106f113d293fffd53797fb86",
                        "Udf78d42ac152679e19357f2b60077ee2",
                    ),
                    "girl"      =>  array(
                        "Ua77f2fb6c54508df6cd89fffe8a49c2a",
                        "U1a07e5e5bd238e75577eba8a2bd62a0f",
                        "Ue010dd79fde25da783dd8464697b9a3b",
                        "U8457af3170674bc2e899f5fe319c3469",
                        "U3aa921ab8339f23a39b20ad0d202bc52",
                        "Udb861c2048e00db8c413b43c54f5eea8",
                        "Uaf1dfc84e41985acfaab8db5c6b1b445",
                        "Uaaf0642621ee5d85987d8be1a9c85417",
                        "U868676081b8492edd73b8b17efac52d2",
                        "U48b6f827c11d56a25b6878dd4e8d8cbd",
                        "U782017e142e874bf8a42db58ab373065",
                        "U10110b4798bc79535aff414033905702",
                        "Ua07fef56f3ec7038a2254df91aa1c882",
                        "U2b423c17fe7c3a0e1c8b61842792d98a",
                        "U29591631b28146df164f9386c71b2275",
                        "U52af8bddf7de40ad9cac375c0b392f1b",
                        "U17819193259490547d627d63735d1d23",
                        "U621e1feabd11bfb7a619e16fd5434159",
                        "Ubed05ba1fa96e25111b0806ad214eff2",
                        "Uc058ec91da69e50a9303ca115276ed00",
                        "Uaa153d5ebb4faa302c03aaa61ed19904",
                        "U448cb7a071dbc3761cd52f73aba5b90a",
                    ),
                    "organizer" =>  array(
                        "U9040c3e285e2d2603c132c25375822d0",
                        "U3aa921ab8339f23a39b20ad0d202bc52",
                        "Udb861c2048e00db8c413b43c54f5eea8",
                        "U0433d6bb8aa9ba6b9f0b5afa24c82c51",
                        "Udd45daf18f379415b3e480f208fbf074",
                    ),
                );
                foreach($line_group_user_ids as $group => $line_user_ids){
                    $group      =   LineGroup::whereLineId($line->id)->whereName($group)->first();
                    foreach($line_user_ids as $line_user_id){
                        $friend =   LineFriend::whereLineId($line->id)->whereLineUserId($line_user_id)->first();
                        if($group && $friend){
                            LineGroupFriend::updateOrCreate(array(
                                "line_id"           =>  $line->id,
                                "line_group_id"     =>  $group->id,
                                "line_friend_id"    =>  $friend->id,
                            ));
                        }
                    }
                }    
            }
        }
    }
}
