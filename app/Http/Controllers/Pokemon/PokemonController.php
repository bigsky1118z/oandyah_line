<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index()
    {
        return view("pokemon.index");
    }

    public function zukan()
    {
        foreach(range(1,1500) as $number){
            $padding_number =   sprintf("%04d",$number);
        }
        $response   =   Http::get("https://zukan.pokemon.co.jp/detail/0001");

        return $response;
    }
}
