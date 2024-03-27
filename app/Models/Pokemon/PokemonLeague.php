<?php

namespace App\Models\Pokemon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonLeague extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "name",
        "start_date",
        "end_date",
        "rule",
        "format",
        "description",
    );

    public function trainers()
    {
        if(PokemonLeagueTrainer::wherePokemonLeagueId($this->id)->count()%2 == 0){
            return $this->hasMany(PokemonLeagueTrainer::class)->orderBy("id");
        }
        if(PokemonLeagueTrainer::wherePokemonLeagueId($this->id)->count()%2 != 0){
            return $this->hasMany(PokemonLeagueTrainer::class)->whereHas("trainer", function($query){
                $query->whereNot("user_name","Bye")->whereNot("trainer_name","Bye");
            })->orderBy("id");
        }
    }

    public function trainer($trainer_id)
    {
        return $this->trainers()->whereId($trainer_id)->first();
    }


    public function matchs()
    {
        return $this->hasMany(PokemonLeagueTrainerMatch::class)->orderBy("round")->orderBy("group");
    }


    public function regist_trainer($trainer_id)
    {
        $trainer    =   PokemonLeagueTrainer::updateOrCreate(
            array(
                "pokemon_league_id"     =>  $this->id,
                "pokemon_trainer_id"    =>  $trainer_id,
            ),
            array()
        );
        return $trainer;
    }

    public function get_ribon($column = "id")
    {
        $result =   array();
        foreach($this->trainers as $trainer){
            $result[$trainer->trainer[$column]]    =   array();
            foreach($trainer->matchs() as $match){
                switch($match->status){
                    case("対戦済"):
                        $value  =   $match->winner->trainer[$column];
                        break;
                    case("未対戦"):
                        $value  =   $match->code;
                        break;
                    default:
                        $value  =   "";
                }
                $result[$trainer->trainer[$column]][$match->opponent($trainer->id)->trainer[$column]]  =    $value;
            }
        }
        return $result;
    }



    public function generate_match()
    {
        $trainers       =   $this->trainers;
        $bye            =   PokemonTrainer::whereUserName("Bye")->whereTrainerName("Bye")->first();
        $trainers_num   =   $trainers->count();
        $round_nums     =   $trainers_num - 1;
        $match          =   array();
        for ($round = 0; $round < $round_nums; $round++) {
            $round_match =   array();
            for ($i = 0; $i < $trainers_num / 2; $i++) {
                $player1    =   $trainers[$i];
                $player2    =   $trainers[$trainers_num - 1 - $i];
                if($player1->trainer->id == $bye->id || $player2->trainer->id == $bye->id){
                    continue;
                }
                $round_match[]  =   array($player1, $player2);
                $registed_match =   PokemonLeagueTrainerMatch::wherePokemonLeagueId($this->id)->where(function($query) use ($player1){
                    $query->where("player1_id", $player1->id)->orWhere("player2_id", $player1->id);
                })->where(function($query) use($player2){
                    $query->where("player1_id", $player2->id)->orWhere("player2_id", $player2->id);
                })->first();
                if($registed_match){
                    PokemonLeagueTrainerMatch::updateOrCreate(
                        array(
                            "pokemon_league_id" =>  $this->id,
                            "code"              =>  $registed_match->code,
                        ),
                        array(
                            "round"             =>  $round,
                            "group"             =>  $i,
                            "player1_id"        =>  $player1->id,
                            "player2_id"        =>  $player2->id,
                        )
                    );
                } else {
                    PokemonLeagueTrainerMatch::Create(array(
                        "pokemon_league_id" =>  $this->id,
                        "code"              =>  random_int(1111,9999),
                        "round"             =>  $round,
                        "group"             =>  $i,
                        "player1_id"        =>  $player1->id,
                        "player2_id"        =>  $player2->id,
                    ));
                }
            }
            $match[] = $round_match;

            // Rotate tra$trainers for next round
            $fisrt_player   =   $trainers->shift();
            $last_player    =   $trainers->pop();
            $trainers->prepend($last_player);
            $trainers->prepend($fisrt_player);
        }
        return $match;
    }
    public function regist_match_result($player1, $player2, $winner)
    {
        $match  =   PokemonLeagueTrainerMatch::wherePokemonLeagueId($this->id)->where(function($query) use ($player1){
            $query->where("player1_id", $player1->id)->orWhere("player2_id", $player1->id);
        })->where(function($query) use($player2){
            $query->where("player1_id", $player2->id)->orWhere("player2_id", $player2->id);
        })->first();
        if($match){
            $match->winner_id  =   $winner->id;
            $match->status     =   "対戦済";
            $match->save();
        }
    }
}
