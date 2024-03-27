@props(array(
    "title"         =>  "SNS O&Yah",
    "description"   =>  "O&Yahが提供するSNSのリンクをまとめるサービス。",
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
    <link rel="stylesheet" href="/css/sns/style.css">
    @if (isset($id) && file_exists(public_path("css/sns/$id.css")))
        <link rel="stylesheet" href="/css/sns/{{ $id }}.css">
    @endif
    {!! isset($head) ? $head :null !!}
</head>
<body id="sns">
    <header>
        <x-sns.header />
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
            <form action="/sns/logout" method="post">
                @csrf
                <span onclick="this.closest('form').submit();">logout</span>
            </form>
        @endauth
    </footer>
    {!! isset($script) ? $script :null !!}
</body>
</html>