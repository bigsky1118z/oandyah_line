<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->diplay_name ?? $app->app_name }}</h2>
        <form action="/{{ $user->user_name }}/{{ $app->app_name }}/webhook" method="post">
            @csrf
            <button type="submit">post</button>
        </form>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>