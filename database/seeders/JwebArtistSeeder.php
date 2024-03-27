<?php

namespace Database\Seeders;

use App\Models\Api\JwebArtist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class JwebArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response   =   Http::get("https://www.johnnys-web.com/s/jwb/api/list/artist_member_list?rw=100");
        if(isset($response["list"])){
            foreach($response["list"] as $artist){
                if(isset($artist["member"])){
                    foreach($artist["member"] as $member){
                        JwebArtist::updateOrCreate(
                            array(
                                "artist_code"   =>  $artist["articode"],
                                "member_code"   =>  $member["code"],

                            ),
                            array(
                                "artist_link"               =>  $artist["link"],
                                "artist_name"               =>  $artist["artiname"],
                                "artist_image_thumb_url"    =>  $artist["image_thumb_url"],
                                "artist_furigana"           =>  $artist["furigana"],
                                "member_name"               =>  $member["name"],
                                "member_furigana"           =>  $member["furigana"],
                                "member_image_thumb_url"    =>  $member["image_thumb_url"],
                                "member_date"               =>  $member["date"],
                            )
                        );
                    }
                }
            }
        }
    }
}
