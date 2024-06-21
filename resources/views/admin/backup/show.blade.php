<x-frame.admin>
    <x-slot name="id">admin-backup-show</x-slot>
    <x-slot name="title">バックアップ</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset('admin') }}">TOP</a></li>
        <li><a href="{{ asset('admin'.'/backup') }}">バックアップ</a></li>
        <li><a href="{{ asset('admin'.'/backup/'.($table["table_name"] ?? null)) }}">{{ $table["title"] }}</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>バックアップ</h2>
        <section>
            <h3>復元</h3>
            
        </section>
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.admin>