<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>友だち一覧 - TOP</h2>
        <table>
            <thead>
                <tr>
                    <th>time</th>
                    <th>user</th>
                    <th>操作</th>
                </tr>
            </thead>    
            <tbody>
                <tr>
                    <td>{{ $app }}</td>
                </tr>
                {{-- @foreach ($app->frineds as $friend)
                    <tr>
                        <td>{{ $friend->created_at }}</td>
                        <td>{{ $friend->friend_id }}</td>
                        <td><button type="button" onclick="console.log('{{ $friend->id }}')">詳細</button></td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </x-slot>
    </x-slot>
</x-frame.web>