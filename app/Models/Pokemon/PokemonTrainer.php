<?php

namespace App\Models\Pokemon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonTrainer extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "user_name",
        "trainer_name",
    );

    public function league()
    {
        return $this->hasMany(PokemonLeagueTrainer::class);
    }
}
