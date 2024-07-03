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
        $app        =   App::where("client_id","1657423958")->first();
        $directory  =   "public/app/$app->client_id/richmenu_content";
        Storage::makeDirectory($directory);
        $files      =   Storage::disk("local")->files($directory);
        Storage::disk("local")->delete($files);
        AppRichmenu::update_richmenus($app);
    }
}
