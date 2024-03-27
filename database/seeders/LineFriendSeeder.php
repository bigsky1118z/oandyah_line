<?php

namespace Database\Seeders;

use App\Models\Line\Line;
use App\Models\Line\LineFriend;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineFriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        // $line   =   Line::whereUserId($user->id)->whereName("jinguji_ozora")->first();
        // if($line){
        //     $friend =   LineFriend::updateOrCreate(array(
        //         "line_id"       =>  $line->id,
        //         "line_user_id"  =>  "Ubaabca160ab17a89e7ede64cc084cbb5",
        //         "naming"        =>  "神宮寺 大空",
        //     ));
        // }
        $line   =   Line::whereUserId($user->id)->whereName("kozu620308")->first();
        if($line){
            $line_user_ids =   array(
                "U39ed56fcdfd58cfaf46e197d4cbe875d" =>  "安 柄泰",
                "Ua77f2fb6c54508df6cd89fffe8a49c2a" =>  "伊藤 亜衣",
                "Udb8681f21c789f06515d8926670b503d" =>  "植松 大起",
                "U1a07e5e5bd238e75577eba8a2bd62a0f" =>  "上村 菜津子",
                "Ue010dd79fde25da783dd8464697b9a3b" =>  "大高 佳菜子",
                "Uf3a43378e9e592437b525e0ef93ecb87" =>  "大森 貴司",
                "U2db53d518e8622eb5f31fee993fcca72" =>  "尾方 健太",
                "U9040c3e285e2d2603c132c25375822d0" =>  "奥村 旅人",
                "U8457af3170674bc2e899f5fe319c3469" =>  "川西 祥子",
                "U3aa921ab8339f23a39b20ad0d202bc52" =>  "柿野 亜衣",
                "Udb861c2048e00db8c413b43c54f5eea8" =>  "片岡 まなみ",
                "U93a1324cd5e786bc0df0a1d7af723437" =>  "木田 三平",
                "U0433d6bb8aa9ba6b9f0b5afa24c82c51" =>  "北角 大空",
                "Uaf1dfc84e41985acfaab8db5c6b1b445" =>  "黒田 有希",
                "Ufde57df893fcba5616d00c7bb6b6b0d9" =>  "小桜 直樹",
                "Uaaf0642621ee5d85987d8be1a9c85417" =>  "齋藤 尚子",
                "U868676081b8492edd73b8b17efac52d2" =>  "島 千智",
                "U48b6f827c11d56a25b6878dd4e8d8cbd" =>  "島田 真実",
                "U782017e142e874bf8a42db58ab373065" =>  "新庄 唯子",
                "Uac030c2045c2f9dc89372d3927fbcbb4" =>  "杉森 寛隆",
                "U10110b4798bc79535aff414033905702" =>  "高木 瞳",
                "Ufd6480639a391948569b1ece4334075b" =>  "辰巳 有弘",
                "Ua07fef56f3ec7038a2254df91aa1c882" =>  "玉置 奈津美",
                "U2b423c17fe7c3a0e1c8b61842792d98a" =>  "中村 悠乃",
                "Udd45daf18f379415b3e480f208fbf074" =>  "中山 晋太郎",
                "U0a1cb75227b3039f509ae2434413d04b" =>  "新山 士彦",
                "Uc5e122a22edf0effe8208fb7e400c272" =>  "古川 哲也",
                "U6a5431136e575d2073f68d278e5f81d4" =>  "藤原 一樹",
                "U29591631b28146df164f9386c71b2275" =>  "本条 梨奈",
                "U52af8bddf7de40ad9cac375c0b392f1b" =>  "前田 朝美",
                "U17819193259490547d627d63735d1d23" =>  "松井 友規惠",
                "U6d1726d30ceddd0d39bbb910c12125b6" =>  "馬渕 良太",
                "U621e1feabd11bfb7a619e16fd5434159" =>  "森下 まり",
                "Ubed05ba1fa96e25111b0806ad214eff2" =>  "山川 真未",
                "U9fef19d6106f113d293fffd53797fb86" =>  "山口 真志",
                "Uc058ec91da69e50a9303ca115276ed00" =>  "山﨑 悠紀子",
                "Udf78d42ac152679e19357f2b60077ee2" =>  "山中 裕貴",
                "Uaa153d5ebb4faa302c03aaa61ed19904" =>  "山西 希美",
                "U448cb7a071dbc3761cd52f73aba5b90a" =>  "吉川 早紀",
                "U37bc96e5d56aeb3d4a124f00f08a9c6c" =>  "大畑 正弘"
            );
            foreach($line_user_ids as $line_user_id => $name) {
                $friend =   LineFriend::updateOrCreate(array(
                    "line_id"       =>  $line->id,
                    "line_user_id"  =>  $line_user_id,
                    "naming"        =>  $name,
                ));
                // $friend->get_bot_profile();
            }
        }
    }
}
