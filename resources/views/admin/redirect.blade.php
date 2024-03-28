<x-frame.admin>
    <x-slot name="id">redirect</x-slot>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <div>
            <p><span id="countdown_timer">2</span>秒後に『LINE公式アプリ応援屋』のトップページにリダイレクトします</p>
            <p>ページが遷移しない場合は、<a href="/admin">こちら</a>をクリックしてください</p>
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
            setInterval(() => location.href = "/admin", 2000);
        </script>
    </x-slot>
</x-frame.admin>