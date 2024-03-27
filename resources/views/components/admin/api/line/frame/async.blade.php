<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex">
        <title>{{ isset($title) ? $title : null }}</title>
        <x-admin.api.line.style.styles />
        {!! isset($head) ? $head : null !!}
    </head>
    <body>
        <header>
        </header>
        <h2>{{ isset($heading) ? $heading : null }}</h2>

        {{ $slot }}
        
        <div style="display:none;">
            {{ isset($hidden) ? $hidden : null }}
        </div>
        {!! isset($script) ? $script : null !!}
    </body>
</html>