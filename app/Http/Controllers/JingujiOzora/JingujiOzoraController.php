<?php

namespace App\Http\Controllers\JingujiOzora;

use App\Http\Controllers\Controller;
use App\Models\JingujiOzora\JingujiOzora;
use App\Models\JingujiOzora\JingujiOzoraTarotCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JingujiOzoraController extends Controller
{
    public function index()
    {
        return view("jinguji_ozora.index");
    }
    public function numerology()
    {
        return view("jinguji_ozora.numerology");
    }
    public function tarot($name = null)
    {
        $tarot_spreads          =   JingujiOzora::$tarot_spreads;
        $data   =   array();
        if($name && $name == "all"){
            $data["all"]        =   JingujiOzoraTarotCard::all();
        } elseif($name && isset($tarot_spreads[$name])){
            $data["spread"]     =   $tarot_spreads[$name];
        } else {
            $data["spreads"]    =   $tarot_spreads;
        }
        return view("jinguji_ozora.tarot", $data);
    }
    
    public function get_tarot_card(Request $request)
    {
        $data   =   array(
            "card"  =>  JingujiOzoraTarotCard::find($request->get("id")),
        );
        return response()->json($data,200);
    }

    public function astrology(Request $request)
    {
        $data   =   array(
            "prefectures"   =>  array_keys(JingujiOzora::$prefectures),
            "values"        =>  array(),
            "result"        =>  array(),
        );
        if($request->has("_token")){
            $values =   array(
                "year"          =>  $request->has("year") ? $request->get("year") : "1990",
                "month"         =>  $request->has("month") ? $request->get("month") : "01",
                "day"           =>  $request->has("day") ? $request->get("day") : "01",
                "hours"         =>  $request->has("hours") ? $request->get("hours") : "00",
                "minutes"       =>  $request->has("minutes") ? $request->get("minutes") : "00",
                "prefecture"    =>  $request->has("prefecture") ? $request->get("prefecture") : "東京都",
            );
            $birthday   =   date("Y-m-d H:i", strtotime($values["year"] . "-" . $values["month"] . "-" . $values["day"] . " " . $values["hours"] . ":" . $values["minutes"] . " -9 hours"));
            $longitude  =   JingujiOzora::$prefectures[$values["prefecture"]]["longitude"];
            $latitude   =   JingujiOzora::$prefectures[$values["prefecture"]]["latitude"];
            $data["values"]                 =   $values;
            $data["result"]["planet_signs"] =   JingujiOzora::get_planet_signs($birthday, $longitude, $latitude);
        }
        return view("jinguji_ozora.astrology", $data);
    }
}
