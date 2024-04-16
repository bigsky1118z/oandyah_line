<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>webhook - TOP</h2>
        <table>
            <thead>
                <tr>
                    <th>時間</th>
                    <th>ユーザー名</th>
                    <th>イベント</th>
                    <th>操作</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($webhooks as $webhook)
                    <tr>
                        <td>{{ $webhook->created_at }}</td>
                        <td>{{ $webhook->get_friend()->get_name() }}</td>
                        <td>{{ $webhook->get_type() }}</td>
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/webhook/{{ $webhook->id }}'">詳細</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-frame.web>