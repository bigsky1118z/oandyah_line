@props(array(
    'title'     => "ウェブサイト名",
    'head'      => null,
    'layout'    => null,
))
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-website.parts.head />
    <link rel="stylesheet" href="/css/style.css">
    <x-website.parts.layout />
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header>
        <x-website.parts.extension-logo />
        {{ $header }}
    </header>
    <main>
        {{ $main }}
    </main>
    <footer>
        {{ $footer }}
    </footer>
</body>
</html>