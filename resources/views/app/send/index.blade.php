<x-frame.web>
    <x-slot name="id">user-app-send-index</x-slot>
    <x-slot name="title">送信メッセージ一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/send') }}">送信メッセージ一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>送信メッセージ一覧</h3>
            <div>
                <ul>
                    <li><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/send/create') }}'">新規作成</button></li>
                </ul>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>index</th>
                        <th>type</th>
                        <th>name</th>
                        <th>message</th>
                        <th>response_code</th>
                        <th>error</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach ($app->sends as $index => $send)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $send->type  ??  null }}</td>
                            <td>{{ $send->get_friend()->get_name()  ??  null }}</td>
                            <td>{{ $send->message->name ?? null}}({{ $send->message->num() ?? null }})</td>
                            <td>{{ $send->response_code ?? null }}</td>
                            <td>{{ $send->error_details ?  json_encode($send->error_details) : null }}</td>
                            <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/friend/{{ $send->id }}'">詳細</button></td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>

