<x-frame.admin>
    <x-slot name="id">admin-backup-show</x-slot>
    <x-slot name="title">バックアップ</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset('admin'.'/backup') }}">バックアップ</a></li>
        <li><a href="{{ asset('admin'.'/backup/'.($table["table_name"] ?? null)) }}">{{ $table["title"] }}復元</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>バックアップ</h2>
        <section>
            <form action="{{ asset('admin/backup/'.($table["table_name"] ?? null)) }}" method="post">
                @csrf
                <h3>復元</h3>
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
        <section>
            @if ($all->count() > 0)
                <h3></h3>
                <table>
                    <thead>
                        <tr>
                            @foreach ($all->first()->toArray() as $key => $value)
                                <th>{{ mb_strimwidth($key, 0, 15, "...", "UTF-8") }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all as $one)
                            <tr>
                                @foreach ($one->toArray() as $key => $value)
                                    <td>{{ mb_strimwidth($value, 0, 15, "...", "UTF-8") }}</td>
                                @endforeach
                            </tr>         
                        @endforeach
                    </tbody>
                </table>
            @else               
            @endif
        </section>
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.admin>