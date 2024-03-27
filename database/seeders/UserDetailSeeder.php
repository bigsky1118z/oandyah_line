<?php

namespace Database\Seeders;

use App\Models\User\UserDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        UserDetail::create(array(
            'user_id'       =>  1,
            'last_name'     =>  '北角',
            'first_name'    =>  '大空',
            'last_kana'     =>  'キタズミ',
            'first_kana'    =>  'ダイスケ',
            'phone'         =>  '080-6122-4722',
            'line'          =>  'line is beatiful',
        ));

        UserDetail::create(array(
            'user_id'       =>  2,
            'last_name'     =>  '社員',
            'first_name'    =>  '枡切',
            'last_kana'     =>  'シャイン',
            'first_kana'    =>  'マスカット',
        ));

        UserDetail::create(array(
            'user_id'       =>  3,
            'last_name'     =>  '得意先',
            'first_name'    =>  '策糸',
            'last_kana'     =>  'トクイサキ',
            'first_kana'    =>  'サクイト',
        ));

        UserDetail::create(array(
            'user_id'       =>  4,
            'last_name'     =>  '未認証',
            'first_name'    =>  'マダ男',
            'last_kana'     =>  'ミニンショウ',
            'first_kana'    =>  'マダオ',
        ));
    }
}
