<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->diplay_name ?? $app->name }}</h2>
        <h3>友だち情報</h3>
        {{ $reply }}
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>