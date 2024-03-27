<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Models\Pokemon\PokemonLeague;
use App\Models\Pokemon\PokemonLeagueTrainer;
use App\Models\Pokemon\PokemonLeagueTrainerMatch;
use App\Models\Pokemon\PokemonTrainer;
use Illuminate\Http\Request;

class PokemonLeagueController extends Controller
{
    public function index()
    {
        $data   =   array(
            "leagues"   =>  PokemonLeague::all(),
        );
        return view("pokemon.league.index", $data);
    }

    public function create($league_id = null)
    {
        $data   =   array();
        if($league_id){
            $data["league"] =   PokemonLeague::find($league_id);
        }
        return view("pokemon.league.create", $data);
    }

    public function store(Request $request, $league_id = 0)
    {
        $league =   PokemonLeague::updateOrCreate(
            array(
                "id"    =>  $league_id,
            ),
            array(
                "name"          =>  $request->get("name"),
                "start_date"    =>  $request->get("start_date"),
                "end_date"      =>  $request->get("end_date"),
                "match_num"     =>  $request->get("match_num"),
            )
        );
        $league->regist_trainer("Bye","Bye");
        return redirect("/pokemon/league");
    }

    public function show($league_id)
    {
        $data   =   array(
            "league"    =>  PokemonLeague::find($league_id),
            "trainers"  =>  PokemonTrainer::whereNot("user_name","Bye")->whereNot("trainer_name","Bye")->get(),
        );
        return view("pokemon.league.show", $data);
    }

    public function match($league_id)
    {
        $data   =   array(
            "matches"   =>  PokemonLeagueTrainerMatch::all(),
            "league"    =>  PokemonLeague::find($league_id),
        );
        return view("pokemon.league.match", $data);
    }

    public function match_result(Request $request, $league_id)
    {
        $id     =   $request->get("name");
        $value  =   $request->get("value");
        PokemonLeagueTrainerMatch::updateOrCreate(
            array(
                "id"                =>  $id,
                "pokemon_league_id" =>  $league_id,
            ),
            array(
                "winner_id"         =>  $value,
                "status"            =>  $value ? "対戦済" : "未対戦",
            )
        );
        $data   =   array();
        return response()->json($data, 200);
    }

    public function delete($league_id)
    {
        $league =   PokemonLeague::find($league_id);
        $league ?   $league->delete() : null;
        return redirect("/pokemon/league");
    }

    public function trainer_store(Request $request, $league_id)
    {
        $league     =   PokemonLeague::find($league_id);
        if($request->has("trainer_id")){
            $trainer    =   PokemonTrainer::find($request->get("trainer_id"));            
        } elseif($request->has("user_name") && $request->has("trainer_name")){
            $trainer    =   PokemonTrainer::Create(array(
                "user_name"     =>  $request->get("user_name"),
                "trainer_name"  =>  $request->get("trainer_name"),
            ));
        }
        if($trainer){
            $league->regist_trainer($trainer->id);
            $league->generate_match();
            return redirect("/pokemon/league/$league_id");
        } else {
            return back()->withInput();
        }
    }

    public function trainer_delete($league_id, $trainer_id = null)
    {
        $trainer    =   PokemonLeagueTrainer::wherePokemonLeagueId($league_id)->wherePokemonTrainerId($trainer_id)->first();
        $trainer    ?   $trainer->delete() : null;
        PokemonLeague::find($league_id)->generate_match();
        return redirect("/pokemon/league/$league_id");
    }

}
