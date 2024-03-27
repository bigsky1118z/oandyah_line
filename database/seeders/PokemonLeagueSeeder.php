<?php

namespace Database\Seeders;

use App\Models\Pokemon\PokemonLeague;
use App\Models\Pokemon\PokemonTrainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokemonLeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $league =   PokemonLeague::Create(array(
            "name"          =>  "ポケモンチャンピオンシップ",
            "start_date"    =>  "2023-09-10",
            "end_date"      =>  "2023-09-10",
            "rule"          =>  "レギュレーションD",
            "format"        =>  "シングル",
            "description"   =>  "",
        ));
        $league->regist_trainer(PokemonTrainer::whereUserName("Bye")->whereTrainerName("Bye")->first()->id);
        $league->generate_match();

        $league =   PokemonLeague::Create(array(
            "name"          =>  "第一回リベシティ大会",
            "start_date"    =>  "2023-09-10",
            "end_date"      =>  "2023-09-10",
            "rule"          =>  "レギュレーションD",
            "format"        =>  "シングル",
            "description"   =>  "とにかく楽しみましょう！",
        ));

        $trainer0   =   $league->regist_trainer(PokemonTrainer::whereUserName("Bye")->whereTrainerName("Bye")->first()->id);
        $trainer1   =   $league->regist_trainer(PokemonTrainer::whereUserName("大空")->whereTrainerName("おおぞら")->first()->id);
        $trainer2   =   $league->regist_trainer(PokemonTrainer::whereUserName("クマ")->whereTrainerName("マッシュ")->first()->id);
        $trainer3   =   $league->regist_trainer(PokemonTrainer::whereUserName("マコ")->whereTrainerName("マコ")->first()->id);
        $trainer4   =   $league->regist_trainer(PokemonTrainer::whereUserName("ぽんたまる")->whereTrainerName("ぽんたまる")->first()->id);
        $trainer5   =   $league->regist_trainer(PokemonTrainer::whereUserName("おたまる")->whereTrainerName("なこのん")->first()->id);
        $trainer6   =   $league->regist_trainer(PokemonTrainer::whereUserName("ふーじー")->whereTrainerName("タマゴ")->first()->id);
        $trainer7   =   $league->regist_trainer(PokemonTrainer::whereUserName("さんなみ")->whereTrainerName("さんなみ")->first()->id);
        $trainer8   =   $league->regist_trainer(PokemonTrainer::whereUserName("たすく")->whereTrainerName("たすく")->first()->id);
        $league->generate_match();
        $result =   array(
            [$trainer1, $trainer2, $trainer2],
            [$trainer1, $trainer3, $trainer3],
            [$trainer1, $trainer4, $trainer1],
            [$trainer1, $trainer5, $trainer1],
            [$trainer1, $trainer6, $trainer1],
            [$trainer1, $trainer7, $trainer7],
            [$trainer1, $trainer8, $trainer8],
            [$trainer2, $trainer3, $trainer3],
            [$trainer2, $trainer4, $trainer4],
            [$trainer2, $trainer5, $trainer2],
            [$trainer2, $trainer6, $trainer6],
            [$trainer2, $trainer7, $trainer2],
            [$trainer2, $trainer8, $trainer8],
            [$trainer3, $trainer4, $trainer3],
            [$trainer3, $trainer5, $trainer3],
            [$trainer3, $trainer6, $trainer6],
            [$trainer3, $trainer7, $trainer3],
            [$trainer3, $trainer8, $trainer3],
            [$trainer4, $trainer5, $trainer4],
            [$trainer4, $trainer6, $trainer6],
            [$trainer4, $trainer7, $trainer7],
            [$trainer4, $trainer8, $trainer4],
            [$trainer5, $trainer6, $trainer6],
            [$trainer5, $trainer7, $trainer7],
            [$trainer5, $trainer8, $trainer5],
            [$trainer6, $trainer7, $trainer7],
            [$trainer6, $trainer8, $trainer6],
            [$trainer7, $trainer8, $trainer7]
        );
        foreach($result as $array){
            $league->regist_match_result($array[0],$array[1], $array[2]);
        }
    }
}
