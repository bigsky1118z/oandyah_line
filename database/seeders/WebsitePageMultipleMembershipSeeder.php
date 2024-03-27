<?php

namespace Database\Seeders;

use App\Models\Website\Page\WebsitePageMultiple;
use App\Models\Website\Page\WebsitePageMultipleMembership;
use App\Models\Website\WebsiteMembership;
use App\Models\Website\WebsitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageMultipleMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsitePageMultipleMembership::Create(array(
            "website_page_multiple_id"  =>  WebsitePageMultiple::whereWebsitePageId(WebsitePage::whereCategory("multiple")->whereName("news")->first()->id)->whereName("hello")->first()->id,
            "website_membership_id"     =>  WebsiteMembership::whereName("ユーザー登録")->first()->id,
        ));

        WebsitePageMultipleMembership::Create(array(
            "website_page_multiple_id"  =>  WebsitePageMultiple::whereWebsitePageId(WebsitePage::whereCategory("multiple")->whereName("news")->first()->id)->whereName("hello")->first()->id,
            "website_membership_id"     =>  WebsiteMembership::whereName("閲覧者")->first()->id,
        ));
    }
}
