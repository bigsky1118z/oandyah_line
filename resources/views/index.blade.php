<x-frame.top>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="description">『LINE公式アプリ応援屋』はLINE Messaging APIを簡単に利用できるようにするサービスです</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
        <a href="/"><h1>LINE公式アプリ応援屋</h1></a>
        <nav id="header_nav">
            <ul id="header_nav_ul">
                <li>メニュー1</li>
                <li>メニュー2</li>
                <li>メニュー3</li>
                @auth
                    <li>{{ auth()->user()->user_name }}</li>
                @endauth
                @guest
                    <li><a href="register">会員登録</a></li>
                    <li><a href="login">ログイン</a></li>
                @endguest
            </ul>
        </nav>
        @auth
            
        @endauth
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>LINE公式アプリを使って集客</h2>
            <h3>LINE公式アプリって？</h3>
            <p>LINE公式アプリとは株式会社LINEが運営するLINE上で使えるサービスです</p>
            <P>日本におけるLINEの利用者はおよそ100人で、日本の人口の約1%が利用しているといわれています</P>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.top>