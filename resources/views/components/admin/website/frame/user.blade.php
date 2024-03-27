@props(array(
    'head'      =>  null,
    'script'    =>  null,
))
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ユーザー管理</title>
        <style>
            .hidden {
                display: none !important;
            }
            ul      {
                margin: 0;
            }
            tfoot   {
                text-align: center;
            }
        </style>
        {!! $head !!}
    </head>
    <body>
        <header>
            <p>
                <button onclick="location.href='/admin'">管理画面トップ</button>
            </p>
        </header>
        <h2>ユーザー管理</h2>

        {{ $slot }}

        {!! $script !!}
    </body>
</html>