<?php

namespace Database\Seeders;

use App\Models\Website\Page\WebsitePageContact;
use App\Models\Website\Page\WebsitePageMenu;
use App\Models\Website\Page\WebsitePageMultiple;
use App\Models\Website\Page\WebsitePageSingle;
use App\Models\Website\WebsitePage;
use App\Models\Website\WebsiteTopLayout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // type:regulated
            foreach(WebsitePage::$regulated_path as $path){
                WebsitePage::Create(array(
                    "path"          =>  $path,
                    "type"          =>  "regulated",
                    "status"        =>  "private",
                    "valid_at"      =>  null,
                    "expired_at"    =>  null,
                ));
            }

        // type:subdirectory
            foreach(WebsitePage::$subdirectories as $path => $title){
                WebsitePage::Create(array(
                    "path"          =>  $path,
                    "type"          =>  "subdirectory",
                    "title"         =>  $title,
                    "status"        =>  "published",
                    "valid_at"      =>  date("Y-m-d 00:00:00"),
                    "expired_at"    =>  null,
                ));
            }

        // type:image
            $page   =   WebsitePage::Create(array(
                "type"          =>  "image",
                "path"          =>  "image-header",
                "title"         =>  "ヘッダー画像",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));

        // type:menu
            $page   =   WebsitePage::Create(array(
                "type"          =>  "menu",
                "path"          =>  "menu_header",
                "title"         =>  "ヘッダーメニュー",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageMenu::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $page   =   WebsitePage::Create(array(
                "type"          =>  "menu",
                "path"          =>  "menu_footer",
                "title"         =>  "フッターメニュー",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageMenu::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $page   =   WebsitePage::Create(array(
                "type"          =>  "menu",
                "path"          =>  "menu_links",
                "title"         =>  "リンク集",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageMenu::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
    
        // type:contact
            $page   =   WebsitePage::Create(array(
                "type"          =>  "contact",
                "path"          =>  "contact",
                "title"         =>  "お問い合わせ",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageContact::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
        // type:single
            $page   =   WebsitePage::Create(array(
                "type"          =>  "single",
                "path"          =>  "greeting",
                "title"         =>  "わたしたちがO&Yahです",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageSingle::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ),array(
                "body"  =>  <<<EOF
                            <p>
                                苦手の克服、憧れへの挑戦、夢の実現。<br />
                                現状から何かを変える、そのあなたの一歩を応援します。<br />
                                私たちはあなたの「応援屋(O&Yah)」です。<br />
                            </p>
                            EOF,
            ));
            $page   =   WebsitePage::Create(array(
                "type"          =>  "single",
                "path"          =>  "concept",
                "title"         =>  "O&Yahの考え",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageSingle::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ),array(
                "body"  =>  <<<EOF
                            <p>
                                O&Yahはあなたの叶えたい夢を実現するための応援をする集団です。
                            </p>
                            <p>
                                新しいことを始めるには勇気がいります。
                            </p>
                            <ul>
                                <li>私にもできるのかな？</li>
                                <li>失敗したらどうしよう？</li>
                                <li>もう今から始めても遅いからやめておこう</li>
                            </ul>
                            <p>
                                と、つい、やらない理由を探してしまします。<br />
                                あなたのその思考は正解です。
                            </p>
                            <p>
                                人の脳は常に「死なない選択肢」を選ぼうとします。
                            </p>
                            <ol>
                                <li>やったことがない</li>
                                <li>失敗したら死ぬかもしれない</li>
                                <li>やめておこう</li>
                            </ol>
                            <p>
                                このように、脳はいま生存できている現状を維持しようと常に考えます。
                            </p>
                            EOF,
            ));
            $page   =   WebsitePage::Create(array(
                "type"          =>  "single",
                "path"          =>  "product",
                "title"         =>  "商品紹介",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageSingle::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ),array(
                "body"  =>  <<<EOF
                            <ul>
                                <li>マネジメント業</li>
                                <li>プロダクション業</li>
                                <li>キャスティング業</li>
                                <li>占い事業</li>
                            <ul>
                            EOF,
            ));
        // type:multiple
            $page   =   WebsitePage::Create(array(
                "type"          =>  "multiple",
                "path"          =>  "news",
                "title"         =>  "新着情報",
                "description"   =>  "最新の情報をお届けします！",
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageMultiple::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $page   =   WebsitePage::Create(array(
                "type"          =>  "multiple",
                "path"          =>  "blog",
                "title"         =>  "ブログ",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageMultiple::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
            $page   =   WebsitePage::Create(array(
                "type"          =>  "multiple",
                "path"          =>  "discography",
                "title"         =>  "ディスコグラフィ",
                "description"   =>  null,
                "status"        =>  "published",
                "valid_at"      =>  date("Y-m-d 00:00:00"),
                "expired_at"    =>  null,
            ));
            WebsitePageMultiple::updateOrCreate(array(
                "website_page_id"   =>  $page->id,
            ));
        

    }
}
