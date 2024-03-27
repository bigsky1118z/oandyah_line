<?php

namespace App\Models\Pokemon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonLeagueTrainerMatch extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "name",
        "code",
        "round",
        "group",
        "pokemon_league_id",
        "player1_id",
        "player2_id",
        "winner_id",
        "status",
    );

    public function player1(){
        return $this->belongsTo(PokemonLeagueTrainer::class,"player1_id");
    }
    public function player2(){
        return $this->belongsTo(PokemonLeagueTrainer::class,"player2_id");
    }


    public function player($player_id){
        return $this->player1->id == $player_id ? $this->player1 : $this->player2;
    }

    public function opponent($player_id){
        return $this->player1->id == $player_id ? $this->player2 : $this->player1;
    }

    public function winner(){
        return $this->belongsTo(PokemonLeagueTrainer::class,"winner_id");
    }
}
