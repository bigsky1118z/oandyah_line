<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Models\Pokemon\PokemonTrainer;
use Illuminate\Http\Request;

class PokemonTrainerController extends Controller
{
    public function index()
    {
        $data   =   array(
            "trainers"   =>  PokemonTrainer::whereNot("user_name","Bye")->whereNot("trainer_name","Bye")->get(),
        );
        return view("pokemon.trainer.index", $data);
    }

    public function store(Request $request, $trainer_id = 0)
    {
        PokemonTrainer::updateOrCreate(
            array(
                "id"    =>  $trainer_id,
            ),
            array(
                "user_name"     =>  $request->get("user_name"),
                "trainer_name"  =>  $request->get("trainer_name"),
            )
        );
        return redirect("/pokemon/trainer");
    }

    public function delete($trainer_id = 0)
    {
        $trainer    =   PokemonTrainer::find($trainer_id);
        $trainer    ?   $trainer->delete()  : null;
        return redirect("/pokemon/trainer");
    }
}
