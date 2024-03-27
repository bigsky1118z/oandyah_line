@php
    use App\Models\Website\WebsiteConfig;
    use App\Models\Website\WebsitePage;
    use App\Models\Website\WebsiteLayout;
@endphp
@props(array(
    "id"                =>  WebsitePage::get_type(Request::path()) ? WebsitePage::get_type(Request::path()) : "default",
    "title"             =>  WebsiteConfig::whereName("title")->exists() ? WebsiteConfig::whereName("title")->first()->value : "website",
    "description"       =>  WebsiteConfig::whereName("description")->exists() ? WebsiteConfig::whereName("description")->first()->value : "",
    "is_display_header_image"   =>  true,
    // "is_display_header_image"   =>  WebsiteConfig::is_display_header_image(Request::path()),
    "url"                       =>  null,



    "membership_page"   =>  WebsiteConfig::whereName("membership_page")->exists() ? WebsiteConfig::whereName("membership_page")->first()->value : "",

    "layout_headers"    =>  WebsiteLayout::whereType($id)->whereTarget("header")->get(),
    "layout_footers"    =>  WebsiteLayout::whereType($id)->whereTarget("footer")->get(),
))
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if (file_exists(public_path("storage/image/website/favicon.ico")))
        <link rel="shortcut icon" href="/storage/image/website/favicon.ico">
    @endif
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    @if (isset($id) && file_exists(public_path("css/$id.css")))
        <link rel="stylesheet" href="/css/{{ $id }}.css">
    @endif
    <link rel="stylesheet" href="/style.css">
    {!! isset($head) ? $head :null !!}
</head>
<body>
    <header>
        <x-website.header.header-logo_title />
        <x-website.header />
        @isset($imageheaderurl)
            <x-website.header.header-image :url="$imageheaderurl" />
        @endisset
        {{ isset($header) ? $header : null }}
    </header>
    <main @isset($id) id="{{ $id }}" @endisset>
        {!! isset($h2) ? "<h2>" . $h2 . "</h2>" : null !!}
        {{ $slot }}
    </main>
    <div style="display:none;">
        {{ isset($hidden) ? $hidden :null }}
    </div>
    <footer>
        <x-website.footer />

        {{ isset($footer) ? $footer : null }}
        <x-website.footer.guide />
        <x-website.footer.copyright />
    </footer>
    {!! isset($script) ? $script :null !!}
</body>
</html>