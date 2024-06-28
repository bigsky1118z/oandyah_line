<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppRichmenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AppRichmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app            =   App::where("client_id","1657423958")->first();
        $files          =   Storage::disk("local")->files("public/app/1657423958/richmenu_content");
        Storage::disk("local")->delete($files);
        $app_richmenus  =   AppRichmenu::update_richmenus($app);
    }
}
