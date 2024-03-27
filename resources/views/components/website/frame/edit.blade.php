<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>[edit]{{ isset($title) ? $title : $title = "edit" }}</title>
    @if (file_exists(public_path("storage/image/website/favicon.ico")))
        <link rel="shortcut icon" href="/storage/image/website/favicon.ico">
    @endif
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/edit.css">
    <link rel="stylesheet" href="/style.css">
    @if (isset($id) && file_exists(public_path("css/edit/$id.css")))
        <link rel="stylesheet" href="/css/edit/{{ $id }}.css">
    @endif
    {!! isset($head) ? $head :null !!}
</head>
<body id="edit">
    <header>
        <h1><a href="/edit">ウェブサイト編集</a></h1>
        {!! isset($h1) ? "<h1>" . $h1 . "</h1>" : null !!}
        {{ isset($header) ? $header : null }}
    </header>
    <main @isset($id) id="{{ $id }}" @endisset>
        {!! isset($h2) ? "<h2>" . $h2 . "</h2>" : null !!}
        {{ $slot }}
    </main>
    <div style="display:none;">
        {{ isset($hidden) ? $hidden :null }}
    </div>
    <footer>
        {{ isset($footer) ? $footer : null }}
        @auth
            <p style="text-align: right">
                <span onclick="window.history.back()" style="cursor: pointer">戻る</span>
                &nbsp;
                <a href="/edit">編集TOP</a>
                &nbsp;
                <a href="/kbox/logout">ログアウト</a>
            </p>
        @endauth
    </footer>

    {!! isset($script) ? $script :null !!}
    {{-- <script>
        document.querySelectorAll('input[type=file]').forEach(input => {
            input.addEventListener('change', () => {
                const files = input.files;
                for (const file of files) {
                    if (file.size > 1024 * 1024) {
                        alert('ファイルサイズが1MBを超えています');
                        input.value = "";
                        return;
                    } else {
                        const preview   =   document.getElementById("img-preview");
                        if(preview){
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                preview.src = e.target.result;
                                preview.classList.remove("hidden");
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                }
            })
        });    
    </script> --}}
</body>
</html>