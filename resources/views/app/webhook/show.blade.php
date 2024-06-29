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
            <h3>送信メッセージ詳細</h3>
            <table>
                <thead>
                    <tr>
                        <th>時間</th>
                        <th>ユーザー名</th>
                        <th>イベント</th>
                    </tr>
                </thead>    
                <tbody>
                    <tr>
                        <td>{{ $webhook->created_at ?? null }}</td>
                        <td>{{ $webhook->get_friend()->get_name() ?? null }}</td>
                        <td>{{ $webhook->get_event_type("title") ?? null }}</td>
                        <td>{{ $webhook->query_string ?? null }}</td>
                        <td>{{ $webhook->response_status_code ?? null }}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                @switch($webhook->get_event_type())
                    @case("message")
                        <tr><td>{{ $webhook->get_event_message_text() }}</td></tr>
                        @break
                    @case("postback")
                        <tr><td>{{ $webhook->get_event_postback_data() }}</td></tr>
                    @default
                @endswitch
            </table>
        </section>
    </x-slot>
</x-frame.web>