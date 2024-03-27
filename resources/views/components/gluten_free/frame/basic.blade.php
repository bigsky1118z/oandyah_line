<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex">
        <title>{{ isset($title) ? $title : $title = "K Box System" }}</title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/style.css">
        <link rel="stylesheet" href="/css/gluten_free/style.css">
        @if (isset($id))
            <link rel="stylesheet" href="/css/gluten_free/{{ $id }}.css">
        @endif
        {!! isset($head) ? $head :null !!}
    </head>
    <body id="gluten_free">
        <header>
            {{ isset($h1) ? $h1 : null }}            
            {{ isset($header) ? $header : null }}
        </header>
        <main  @isset($id) id="{{ $id }}" @endisset>
            {{ isset($h2) ? $h2 : null }}
            {{ $slot }}
            <div style="display:none;">
                {{ isset($hidden) ? $hidden : null }}
            </div>
        </main>
        <footer>
            {{ isset($footer) ? $footer : null }}
            <x-gluten_free.footer.copyright :title="$title" />
        </footer>
        {!! isset($script) ? $script : null !!}
    </body>
</html>