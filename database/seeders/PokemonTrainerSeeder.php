<?php

namespace Database\Seeders;

use App\Models\Pokemon\PokemonTrainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokemonTrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PokemonTrainer::Create(array(
            "user_name"     =>  "Bye",
            "trainer_name"  =>  "Bye",
        ));

        // PokemonTrainer::Create(array(
        //     "user_name"     =>  "スカーレット",
        //     "trainer_name"  =>  "スカーレット",
        // ));

        // PokemonTrainer::Create(array(
        //     "user_name"     =>  "バイオレット",
        //     "trainer_name"  =>  "バイオレット",
        // ));

        // PokemonTrainer::Create(array(
        //     "user_name"     =>  "サトシ",
        //     "trainer_name"  =>  "サトシ",
        // ));

        // PokemonTrainer::Create(array(
        //     "user_name"     =>  "リコ",
        //     "trainer_name"  =>  "リコ",
        // ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "大空",
            "trainer_name"  =>  "おおぞら",
        ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "クマ",
            "trainer_name"  =>  "マッシュ",
        ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "マコ",
            "trainer_name"  =>  "マコ",
        ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "ぽんたまる",
            "trainer_name"  =>  "ぽんたまる",
        ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "おたまる",
            "trainer_name"  =>  "なこのん",
        ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "ふーじー",
            "trainer_name"  =>  "タマゴ",
        ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "さんなみ",
            "trainer_name"  =>  "さんなみ",
        ));

        PokemonTrainer::Create(array(
            "user_name"     =>  "たすく",
            "trainer_name"  =>  "たすく",
        ));

    }
}
