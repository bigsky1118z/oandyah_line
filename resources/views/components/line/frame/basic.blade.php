@props(array(
    "title"         =>  "LINE公式アカウント O&Yah",
    "description"   =>  "O&Yahが提供するLINE公式アカウント",
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
    <link rel="stylesheet" href="/css/line/style.css">
    @if (isset($id) && file_exists(public_path("css/line/$id.css")))
        <link rel="stylesheet" href="/css/line/{{ $id }}.css">
    @endif
    {!! isset($head) ? $head :null !!}
</head>
<body id="line">
    <header>
        <h1><a href="/line">LINE O&Yah</a></h1>
        {{ isset($header) ? $header : null }}
    </header>
    <main @isset($id) id="{{ $id }}" @endisset>
        {{ $slot }}
    </main>
    <div style="display:none;">
        {{ isset($hidden) ? $hidden :null }}
    </div>
    <footer>
        {{ isset($footer) ? $footer : null }}
        @auth
            <form action="/line/logout" method="post">
                @csrf
                <span onclick="this.closest('form').submit();">logout</span>
            </form>
        @endauth
    </footer>
    {{-- <div id="iframe" class="hidden" onclick="this.classList.add('hidden')"> --}}
    <div id="iframe" class="hidden">
        {{ isset($iframe) ? $iframe : null }}
        <button type="button" id="iframe-button-close" onclick="get_iframe();">閉じる</button>
    </div>
    {!! isset($script) ? $script :null !!}
</body>
</html>