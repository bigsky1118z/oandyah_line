<x-frame.top>
    <x-slot name="id">redirect</x-slot>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="description">『LINE公式アプリ応援屋』のトップページにリダイレクトします</x-slot>

    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
        <h1>LINE公式アプリ応援屋</h1>
    </x-slot>
    <x-slot name="main">
        <div>
            <p><span id="countdown_timer">5</span>秒後に『LINE公式アプリ応援屋』のトップページにリダイレクトします</p>
            <p>ページが遷移しない場合は、<a href="/">こちら</a>をクリックしてください</p>
        </div>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            setInterval(() => {
                const target        =   document.getElementById("countdown_timer");
                target.textContent  =   Number(target.textContent) - 1;
            }, 1000);
            setInterval(() => location.href = "/", 5000);
        </script>
    </x-slot>
</x-frame.top>