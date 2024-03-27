@props(array(
    'title'     =>  null,
    'heading'   =>  null,
    'head'      =>  null,
    'hidden'    =>  null,
    'script'    =>  null,
))
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex">
        <title>{{ $title }}</title>
        <style>
            .hidden {
                display: none !important;
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
                <button onclick="history.back();">戻る</button>
                <button onclick="location.href='/admin/website'">サイト設定</button>
                <button onclick="location.href='/admin'">管理画面トップ</button>
            </p>
        </header>
        <h2>{{ $heading }}</h2>

        {{ $slot }}
        
        <div style="display:none;">
            {{ $hidden }}
        </div>

        {!! $script !!}
    </body>
</html>