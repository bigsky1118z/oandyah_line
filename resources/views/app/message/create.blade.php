<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->diplay_name ?? $app->name }}</h2>
        <div>{{ json_encode($user) }}</div>
        <div>{{ json_encode($app) }}</div>
        <div>{{ json_encode($message) }}</div>

        
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>