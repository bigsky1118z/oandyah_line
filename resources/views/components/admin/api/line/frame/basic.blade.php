@props(array(
    'title'     =>  null,
    'heading'   =>  null,
    'head'      =>  null,
    'hidden'    =>  null,
    'modal'     =>  null,
    'script'    =>  null,
    'channel'   =>  null,
    "id"        =>  null,
))
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex">
        <title>{{ $title }}</title>
        <x-admin.api.line.style.styles />
        {!! $head !!}
    </head>
    <body @isset($id) id="{{ $id }}" @endisset>
        <header>
            <p>
                <button onclick="history.back();">戻る</button>
                @if($channel)<button onclick="location.href='/api/line/{{ $channel->channel_name }}'">{{ $channel->channel_title ? $channel->channel_title : "チャンネル" }}トップ</button>@endif
                <button onclick="location.href='/api/line'">管理画面トップ</button>
            </p>
        </header>
        <h2>{{ $heading }}</h2>

        {{ $slot }}
        
        <div style="display:none;">
            {{ $hidden }}
        </div>
        
        <div id="modal">
            {{ $modal }}
        </div>

        {!! $script !!}
    </body>
</html>