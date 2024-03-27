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
        <title>{{ isset($title) ? $title : "究極の未来へ導く占い師 神宮寺大空" }}</title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/jinguji_ozora/style.css">
        @if (isset($id) && $id == "tarot")
            <link rel="stylesheet" href="/css/jinguji_ozora/tarot.css">
        @endif
        @if (isset($id) && $id == "numerology")
            <link rel="stylesheet" href="/css/jinguji_ozora/numerology.css">        
        @endif
        @if (isset($id) && $id == "astrology")
            <link rel="stylesheet" href="/css/jinguji_ozora/astrology.css">        
        @endif
        @if (isset($id) && ($id == "tarot" || $id == "numerology"))
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
        @endif
        {{-- <link rel="stylesheet" href="/style.css"> --}}
        {!! $head !!}
    </head>
    <body id="jinguji_ozora">
        <header>
            <div id="header-logo-title">
                <h1>
                    <a href="/jinguji_ozora">
                        {{-- <img class="logo" src="/storage/image/config/logo.png"> --}}
                        <span class="title">究極の未来へ導く占い師 神宮寺大空</span>
                    </a>
                </h1>                
            </div>
            {{ isset($header) ? $header : null }}
        </header>
        <main  @isset($id) id="{{ $id }}" @endisset>
            {{ $slot }}
            <div style="display:none;">
                {{ $hidden }}
            </div>
            
            <div id="modal">
                {{ $modal }}
            </div>
            
            {!! $script !!}
        </main>
        <footer>
            {{ isset($footer) ? $footer : null }}
            <p id="copyright">Copyright 究極の未来へ導く占い師 神宮寺大空&copy; {{ date("Y") }} All Rights Reserved</p>
        </footer>
    </body>
</html>