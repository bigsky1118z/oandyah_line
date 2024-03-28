<x-frame.top>
    <x-slot name="title">[管理画面]LINE公式アプリ応援屋</x-slot>
    {{-- <x-slot name="description">『LINE公式アプリ応援屋』はLINE Messaging APIを簡単に利用できるようにするサービスです</x-slot> --}}
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
        <nav id="header-nav">
            <ul id="header-nav-ul">
                <li>メニュー1</li>
                <li>メニュー2</li>
                <li>メニュー3</li>
                <li>メニュー4</li>
            </ul>
        </nav>
    </x-slot>
    <x-slot name="main">
        <section>user</section>
        @foreach ($users as $user)
            {{ $user }}
        @endforeach
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.top>