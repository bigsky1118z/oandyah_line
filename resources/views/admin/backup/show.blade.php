<x-frame.admin>
    <x-slot name="id">admin-backup-show</x-slot>
    <x-slot name="title">バックアップ</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset('admin') }}">TOP</a></li>
        <li><a href="{{ asset('admin'.'/backup') }}">バックアップ</a></li>
        <li><a href="{{ asset('admin'.'/backup/'.($table["table_name"] ?? null)) }}">{{ $table["title"] }}復元</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>バックアップ</h2>
        <section>
            <form action="{{ asset('admin/backup/'.($table["table_name"] ?? null)) }}" method="post">
                @csrf
                <h3>{{ $table["title"] }}復元</h3>
                <table>
                    <tr>
                        <th>バックアップデータ</th>
                        <td>
                            <select name="file_name">
                                @foreach ($file_names as $file_name)
                                    <option value="{{ $file_name }}">{{ str_replace("private/backup/".($table["table_name"] ?? ""),"",$file_name) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><button type="submit">復元</button></td>
                    </tr>
                </table>
            </form>
        </section>
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.admin>