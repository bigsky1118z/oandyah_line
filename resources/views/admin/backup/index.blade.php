<x-frame.admin>
    <x-slot name="id">admin-backup-index</x-slot>
    <x-slot name="title">バックアップ</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset('admin' . '/backup') }}">バックアップ</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>バックアップ</h2>
        <section>
            <h3>データベース一覧</h3>
            <table>
                <tbody>
                    @foreach ($tables as $table_name => $table)
                        <tr>
                            <td>{{ $table['title'] ?? $table_name }}</td>
                            <td><button type="button" onclick="location.href='{{ asset('admin/backup/'.$table_name) }}'">詳細</button></td>
                            <td><button type="button" onclick="location.href='{{ asset('admin/backup/'.$table_name.'/backup') }}'">バックアップ</button></td>
                            <td><button type="button" onclick="location.href='{{ asset('admin/backup/'.$table_name.'/download') }}'">ダウンロード</button></td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </section>

    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.admin>