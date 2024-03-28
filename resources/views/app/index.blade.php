<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>ユーザーページ - TOP</h2>
        <ul>
            @foreach ($user->apps as $app)
                <li><a href="/{{ $user->user_name }}/{{ $app->app_name }}" target="_blank" rel="noopener noreferrer">{{ $app->display_name ?? $app->app_name }}</a></li>
            @endforeach
        </ul>
        {{ $route }}
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>