<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) && $title == "LINE公式アプリ応援屋" ? $title . " " : null }}LINE公式アプリ応援屋</title>
        <meta name="description" content="{{ $description ?? 'エンターテイメント応援事業O&Yahが運営する、LINE公式アカウントを用いたビジネスツールです。' }}" />
        <link rel="stylesheet" href="{{ asset("css/style.css") }}">
        {!! $head ?? null !!}
    </head>
    <body id="{{ $id ?? null }}">
        <header>
            <a href="/"><h1>LINE公式アプリ応援屋</h1></a>
            <x-web.web_header_nav />
            {{ $header ?? null }}
        </header>
        <main>
            {{ $main ?? null }}
            {{ $slot }}
            <div class="hidden" style="display: none;">
                {{ $hidden ?? null }}
            </div>
        </main>
        <footer>
            {{ $footer ?? null }}
            <div id="copyright">エンターテイメント応援事業O&Yah &copy; {{ date("Y") }} All Rights Reserved</div>
        </footer>
        {!! $script ?? null !!}
    </body>
</html>