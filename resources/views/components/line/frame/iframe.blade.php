<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/line/iframe.css">
    {!! isset($head) ? $head :null !!}
</head>
<body id="line-iframe">
    <header>
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
    </footer>
    {!! isset($script) ? $script :null !!}
</body>
</html>