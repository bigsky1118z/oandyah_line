<?php

namespace Database\Seeders;

use App\Models\Website\WebsiteMembership;
use App\Models\Website\WebsitePage;
use App\Models\Website\WebsitePageMembership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsitePageMembership::Create(array(
            "website_page_id"       =>  WebsitePage::whereCategory("single")->whereName("product")->first()->id,
            "website_membership_id" =>  WebsiteMembership::whereName("管理者")->first()->id,
        ));

        WebsitePageMembership::Create(array(
            "website_page_id"       =>  WebsitePage::whereCategory("single")->whereName("concept")->first()->id,
            "website_membership_id" =>  WebsiteMembership::whereName("ユーザー登録")->first()->id,
        ));
        WebsitePageMembership::Create(array(
            "website_page_id"       =>  WebsitePage::whereCategory("single")->whereName("concept")->first()->id,
            "website_membership_id" =>  WebsiteMembership::whereName("管理者")->first()->id,
        ));
        WebsitePageMembership::Create(array(
            "website_page_id"       =>  WebsitePage::whereCategory("single")->whereName("concept")->first()->id,
            "website_membership_id" =>  WebsiteMembership::whereName("編集者")->first()->id,
        ));
        WebsitePageMembership::Create(array(
            "website_page_id"       =>  WebsitePage::whereCategory("single")->whereName("concept")->first()->id,
            "website_membership_id" =>  WebsiteMembership::whereName("閲覧者")->first()->id,
        ));
    }
}
