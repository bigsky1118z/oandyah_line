<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\WebsitePageFunctionFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SubdirectorySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSubdirectoryRoleSeeder::class);
        
        $this->call(WebsiteConfigSeeder::class);
        $this->call(WebsiteStyleSeeder::class);

        $this->call(WebsitePageSeeder::class);
            $this->call(WebsitePageContactFormSeeder::class);
            $this->call(WebsitePageMultipleArticleSeeder::class);
            $this->call(WebsitePageMenuLinkSeeder::class);
        
        $this->call(WebsiteLayoutSeeder::class);


        $this->call(KboxCompanySeeder::class);
            $this->call(KboxCompanyAddressSeeder::class);
            $this->call(KboxCompanyContactSeeder::class);
        $this->call(KboxSheetSeeder::class);
        // $this->call(KboxProductSeeder::class);
        // $this->call(KboxSemiProductSeeder::class);
        // $this->call(KboxProductSemiProductSeeder::class);



        // $this->call(WebsitePageMultipleMembershipSeeder::class);

        $this->call(JingujiOzoraTarotCardSeeder::class);

        $this->call(PokemonTrainerSeeder::class);
        $this->call(PokemonLeagueSeeder::class);
        
        $this->call(GlutenFreeShopSeeder::class);

        $this->call(SnsSeeder::class);
        $this->call(SnsLinkSeeder::class);

        $this->call(LineSeeder::class);
        $this->call(LineGroupSeeder::class);
        $this->call(LineFriendSeeder::class);
        $this->call(LineGroupFriendSeeder::class);
        
        $this->call(LineMessageTextSeeder::class);
        $this->call(LineMessageStickerSeeder::class);
        $this->call(LineMessageImageSeeder::class);
        $this->call(LineMessageVideoSeeder::class);
        $this->call(LineMessageAudioSeeder::class);
        $this->call(LineMessageLocationSeeder::class);
        $this->call(LineMessageTemplateSeeder::class);
        $this->call(LineMessageImagemapSeeder::class);
        $this->call(LineMessageFlexSeeder::class);
        $this->call(LineMessageSeeder::class);

    }
}
