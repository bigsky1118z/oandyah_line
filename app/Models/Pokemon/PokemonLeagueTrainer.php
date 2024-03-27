<?php

namespace App\Models\Pokemon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonLeagueTrainer extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "pokemon_league_id",
        "pokemon_trainer_id",
    );

    public function trainer()
    {
        return $this->belongsTo(PokemonTrainer::class, "pokemon_trainer_id");
    }

    public function league()
    {
        return $this->belongsTo(PokemonLeague::class, "pokemon_league_id");
    }

    public function matchs()
    {
        return PokemonLeagueTrainerMatch::where(fn($query)=>$query->where("player1_id", $this->id)->orWhere("player2_id", $this->id))->get();
    }

    public function match_num()
    {
        return $this->matchs()->where("status","対戦済")->count();
    }

    public function win_num()
    {
        return $this->matchs()->where("status","対戦済")->where("winner_id",$this->id)->count();
    }

    public function lose_num()
    {
        return $this->matchs()->where("status","対戦済")->where("winner_id","!=",$this->id)->count();
    }

    public function win_rate()
    {
        return $this->match_num() == 0 ? -1 : $this->win_num() / $this->match_num() * 100 ;

    }

}
