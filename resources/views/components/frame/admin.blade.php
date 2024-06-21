<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>[管理画面]{{ isset($title) && $title != "LINE公式アプリ応援屋" ? $title . " " : null }}LINE公式アプリ応援屋</title>
        <meta name="description" content="{{ $description ?? 'エンターテイメント応援事業O&Yahが運営する、LINE公式アカウントを用いたビジネスツールです。' }}" />
        <meta name="robots" content="noindex" />
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        {!! $head ?? null !!}
    </head>
    <body @isset($id) id="{{ $id }}" @endisset>
        <header>
            <a href="{{ asset('admin') }}"><h1>[管理画面]LINE公式アプリ応援屋</h1></a>
            <x-admin.admin_header_nav />
            {{ $header ?? null }}
            <menu class="page-transition">
                <ul>
                    <li><a href="{{ asset("admin") }}">管理画面TOP</a></li>
                    {{ $page_transition_list ?? null }}
                </ul>
            </menu>
        </header>
        <main>
            {{ $main ?? null }}
            {{ $slot }}
        </main>
        <footer>
            {{ $footer ?? null }}
            <div id="copyright">エンターテイメント応援事業O&Yah &copy; {{ date("Y") }} All Rights Reserved</div>
        </footer>
        <div class="hidden" style="display: none;">
            {{ $hidden ?? null }}
        </div>
        {!! $script ?? null !!}
    </body>
</html>