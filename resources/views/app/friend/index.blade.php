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
                    <th>アイコン</th>
                    <th>LINE表示名</th>
                    <th>登録名</th>
                    <th>ステータス</th>
                    <th>操作</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($app->friends as $friend)
                    <tr>
                        <td><img src="{{ $friend->picture_url }}" alt="" width="50px" height="50px"></td>
                        <td>{{ $friend->display_name }}</td>
                        <td>{{ $friend->naming }}</td>
                        <td>{{ $friend->status }}</td>
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/friend/{{ $friend->id }}'">詳細</button></td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>