@props(array(
    'title'         =>  'ここにサイト名が入ります',
    'description'   => 'ここにサイトの説明文が入ります',
    'article'       => null,
    'head'          => null,
))
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ $description }}">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/css/style.css">
    <title>{{ $article }} - {{ $title }}</title>
    {{ $head }}
</head>
<body>
<header>
    {{-- <h1 id="header-logo">
        <a href="/" rel="home">
            <img id="header-logo-icon" src="/img/logo.png" alt="北角紙器株式会社">
            <span id="header-logo-title">{{ $title }}</span>
        </a>
    </h1>
    {{ $header_menu }}
    <div id="header-image">
        <img src="/img/header.png" alt="製品ラインアップ">
    </div> --}}
</header>
<main>
{{ $slot }}
{{ $script }}
</main>
<footer>
    <nav>
    </nav>
    <p id="copyright">©{{ $title }}2022</p>
</footer>
</body>
</html>