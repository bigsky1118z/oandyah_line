<x-website.frame.basic>
<x-slot name="id">redirect</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="description"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="h1"></x-slot> --}}
<x-slot name="head">
    <style>
                div#header-logo-title {
            width: 100%;
            height: 50px;
            text-align: center;
            background-color: #FF99FF;
        }
        div#header-logo-title > h1 {
            height: 50px;
            width: 100%;
        }

        div#header-logo-title > h1 > a {
            display: flex;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 50px;
        }

        div#header-logo-title > h1 > a > img.logo {
            height: 50px;
        }

        div#header-logo-title.header-logo-title-fixed {
            position: fixed;
            width: 100%;
            max-width: 1920px;
            left: 0;
            top: 0;
        }
        div.header-blank {
            width: 100%;
            height: 50px;
        }

        div#header-logo-title.header-logo-title-left > h1 > a {
            justify-content: left;

        }

        div#header-logo-title.header-logo-title-right > h1 > a {
            justify-content: right;
        }
    </style>
</x-slot>
<x-slot name="header"></x-slot>
<div style="height: 100vh">
    <p>ページが見つかりません。<span id="number-countdown">5</span>秒後にトップページに移動します。</p>
    <p>移動しない場合はクリックしてください<a href="/" class="button button-create">トップページ</a></p>
</div>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script">
    <script>
        setInterval(() => {
            const target    =   document.getElementById("number-countdown");
            target.textContent  =   Number(target.textContent) - 1;
        }, 1000);
        setInterval(() => location.href = "/", 5000);
    </script>
</x-slot>
</x-website.frame.basic>