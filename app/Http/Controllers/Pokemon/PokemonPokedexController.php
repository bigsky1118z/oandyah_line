<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Models\Pokemon\PokemonPokedex;
use Illuminate\Http\Request;

class PokemonPokedexController extends Controller
{
    public function index()
    {
        $data   =   array(
            "pokemons"  =>  PokemonPokedex::all(),
        );
        return view("pokemon.pokedex.index", $data);
    }
}
