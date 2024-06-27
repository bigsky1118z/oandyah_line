<x-frame.web>
    <x-slot name="id">user-app-webhook-index</x-slot>
    <x-slot name="title">Webhook一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/webhook') }}">Webhook一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>送信メッセージ一覧</h3>
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
                            <td>{{ $webhook->get_event_type("title") }}</td>
                            <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/webhook/{{ $webhook->id }}'">詳細</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
</x-frame.web>