<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Jweb;
use App\Models\Api\JwebArtist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JwebController extends Controller
{

    public static function schedule_check_posts()
    {
        $response   =   Http::get("https://www.johnnys-web.com/s/jwb/api/list/newContents?rw=500");
        if(isset($response["list"])){
            foreach($response["list"] as $list){
                if(Jweb::whereType($list["type"])->whereCode($list["code"])->doesntExist()){
                    $jweb   =   new Jweb();
                    $jweb->fill($list)->save();

                }
            }
        }
    }

    public function artist()
    {
        $data       =   array(
            "artists"   =>  JwebArtist::all(),
        );
        return view("api.jweb.artist", $data);
    }


    public function index()
    {
        return view("api.jweb.index");
    }

    public function archive()
    {
        $data   =   array(
            "archives"  =>  Jweb::orderByDesc("date")->orderByDesc("code")->get(),
        );
        return view("api.jweb.archive", $data);
    }
}
