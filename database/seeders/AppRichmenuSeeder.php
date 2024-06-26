<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\App\AppRichmenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppRichmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app            =   App::where("client_id","1657423958")->first();
        $app_richmenu   =   AppRichmenu::updateOrCreate(array(
            "app_id"        =>  $app->id,
            "richmenu_id"   =>  "richmenu-3894dc90047a4080e4cce5599feaae06",
        ));
        $app_richmenu->latest();
    }
}
