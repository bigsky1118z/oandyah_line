<x-website.frame.edit>
<x-slot name="title">config</x-slot>
<x-slot name="id">config</x-slot>
<x-slot name="head"></x-slot>
{{-- <x-slot name="h1"></x-slot> --}}
<x-slot name="header"></x-slot>
<x-slot name="h2">ウェブサイト設定 TOP</x-slot>
<section id="index">
    <dl>
        <dt><h4>一般</h4></dt>
        <dd>
            <dl class="dl-flex">
                <dt class="dt-config-index-name">ウェブサイトタイトル</dt>
                <dd class="dd-config-index-value">{{ isset($title) ? $title : "---" }}</dd>
                <dd class="dd-config-index-button">
                    <button type="button" onclick="location.href = '/edit/config/title'">edit</button>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt class="dt-config-index-name">ウェブサイトの説明</dt>
                <dd class="dd-config-index-value">{!! isset($description) ? nl2br($description) : "---" !!}</dd>
                <dd class="dd-config-index-button">
                    <button type="button" onclick="location.href = '/edit/config/description'">edit</button>
                </dd>
            </dl>
        </dd>
        <dt><h4>共通画像登録</h4></dt>
        <dd>
            <dl class="dl-flex">
                <dt class="dt-config-index-name">ロゴ</dt>
                <dd class="dd-config-index-value">{!! file_exists(public_path("storage/image/website/logo.png")) ? "<img src='/storage/image/website/logo.png'>" : "no image" !!}</dd>
                <dd class="dd-config-index-button">
                    <button type="button" onclick="location.href = '/edit/config/logo'">edit</button>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt class="dt-config-index-name">ファビコン</dt>
                <dd class="dd-config-index-value">{!! file_exists(public_path("storage/image/website/favicon.ico")) ? "<img src='/storage/image/website/favicon.ico'>" : "no image" !!}</dd>
                <dd class="dd-config-index-button">
                    <button type="button" onclick="location.href = '/edit/config/favicon'">edit</button>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt class="dt-config-index-name">画像なし</dt>
                <dd class="dd-config-index-value">{!! file_exists(public_path("storage/image/website/no_image.png")) ? "<img src='/storage/image/website/no_image.png'>" : "no image" !!}</dd>
                <dd class="dd-config-index-button">
                    <button type="button" onclick="location.href = '/edit/config/no_image'">edit</button>
                </dd>
            </dl>
        </dd>
        <dt><h4>ヘッダー設定</h4></dt>
        <dd>
            <dl class="dl-flex">
                <dt class="dt-config-index-name">ロゴの表示形式</dt>
                <dd class="dd-config-index-value">{{ isset($header_logo_title) && isset($header_logo_titles) && isset($header_logo_titles[$header_logo_title]) ? $header_logo_titles[$header_logo_title] : "---" }}</dd>
                <dd class="dd-config-index-button">
                    <button type="button" onclick="location.href = '/edit/config/header_logo_title'">edit</button>
                </dd>
            </dl>
        </dd>
        @foreach (array("logo_title" => "ロゴ", "image" => "ヘッダー画像") as $key=> $value)
            <dd>
                <dl class="dl-flex">
                    <dt class="dt-config-index-name">{{ $value }}を表示するページ</dt>
                    <dd class="dd-config-index-value">{{ isset(${"display_header_$key"}) && isset($is_displays) && isset($is_displays[${"display_header_$key"}]) ? $is_displays[${"display_header_$key"}] : "---" }}</dd>
                    <dd class="dd-config-index-button">
                        <button type="button" onclick="location.href = '/edit/config/display_header_{{ $key }}'">edit</button>
                    </dd>
                </dl>
            </dd>
        @endforeach
        {{-- <dd>
            <dl class="dl-flex">
                <dt class="dt-config-index-name">membership_page</dt>
                <dd class="dd-config-index-value">{{ isset($membership_page) && isset($membership_pages) && isset($membership_pages[$membership_page]) ? $membership_pages[$membership_page] : "---" }}</dd>
                <dd class="dd-config-index-button">
                    <button type="button" onclick="location.href = '/edit/config/membership_page'">edit</button>
                </dd>
            </dl>
        </dd> --}}
        <dt><h4>ページ種類ごとのレイアウト設定</h4></dt>
        @foreach (array("single"=> "単独","multiple" => "複合", "multiple_article" => "記事", "menu" => "メニュー") as $type_key => $type_value)
            <dd>
                <dl class="dl-flex">
                    <dt class="dt-config-index-name">{{ $type_value }}</dt>
                    <dd class="dd-config-index-value">{{ isset(${"layout_$type_key"}) ? ${"layout_$type_key"} : "---" }}</dd>
                    <dd class="dd-config-index-button">
                        <button type="button" onclick="location.href = '/edit/config/layout_{{ $type_key }}'">edit</button>
                    </dd>
                </dl>
            </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
</x-website.frame.edit>