@props(array(
    'heading'   =>  null,
    'head'      =>  null,
    'hidden'    =>  null,
    'modal'     =>  null,
    'script'    =>  null,
    'channel'   =>  null,
))
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title : "ポケモン応援屋" }}</title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/pokemon/style.css">
        @if (isset($id) && $id == "league")
            <link rel="stylesheet" href="/css/pokemon/league.css">        
        @endif
        {!! $head !!}
    </head>
    <body id="pokemon">
        <header>
            {{ isset($header) ? $header : null }}
        </header>
        <main  @isset($id) id="{{ $id }}" @endisset>
            {{ $slot }}
        </main>
        <div style="display:none;">
            {{ $hidden }}
        </div>
        
        <div id="modal">
            {{ $modal }}
        </div>

        {!! $script !!}
    </body>
</html>