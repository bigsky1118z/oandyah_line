@props(array(
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
        <title>{{ isset($title) ? $title : $title = "K Box System" }}</title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/style.css">
        <link rel="stylesheet" href="/css/kbox/style.css">
        @if (isset($id) && $id == "company")
            <link rel="stylesheet" href="/css/kbox/company.css">
        @endif
        @if (isset($id) && $id == "sheet")
            <link rel="stylesheet" href="/css/kbox/sheet.css">
        @endif
        @if (isset($id) && $id == "user")
            <link rel="stylesheet" href="/css/kbox/user.css">
        @endif
        @if (isset($id) && ($id == "product" || $id == "semi_product"))
            <link rel="stylesheet" href="/css/kbox/product.css">
        @endif
        {!! isset($head) ? $head :null !!}
    </head>
    <body id="kbox">
        <header>
            {{ isset($h1) ? $h1 : null }}            
            {{ isset($header) ? $header : null }}
        </header>
        <main  @isset($id) id="{{ $id }}" @endisset>
            {{ isset($h2) ? $h2 : null }}
            {{ $slot }}
        </main>
        <div style="display:none;">
            {{ $hidden }}
        </div>
        <footer>
            {{ isset($footer) ? $footer : null }}
            @auth
                <p style="font-size: 10px; text-align: right;"><a href="/kbox/logout">ログアウト</a></p>
            @endauth
            <x-kbox.footer.copyright :title="$title" />
        </footer>
        {!! $script !!}
    </body>
</html>