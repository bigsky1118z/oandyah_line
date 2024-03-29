<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $user->diplay_name ?? $user->name }}</h2>
        <form action="/{{ $user->name }}/{{ $app->name }}/webhook" method="post">
            {{-- @csrf --}}
            <button type="submit">post</button>
        </form>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>