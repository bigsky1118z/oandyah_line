<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>webhook - TOP</h2>
        <ul>
            @foreach ($webhooks as $webhook)
                <li>{{ $webhook }}</li>
            @endforeach
        </ul>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>