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
                    <th>time</th>
                    <th>user</th>
                    <th>type</th>
                    <th>操作</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($webhooks as $webhook)
                    <tr>
                        <td>{{ $webhook->created_at }}</td>
                        <td>{{ $webhook->user_id }}</td>
                        <td>{{ $webhook->type }}</td>
                        <td>{{ $webhook->response_status }}</td>
                        <td>{{ $webhook->mode }}</td>
                        <td>{{ $webhook->request_body }}</td>
                        <td>{{ json_encode($webhook->event) }}</td>
                        <td><button type="button" onclick="console.log('{{ $webhook->id }}')">詳細</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-frame.web>