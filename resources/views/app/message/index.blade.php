<x-frame.web>
    <x-slot name="id">user-app-message-index</x-slot>
    <x-slot name="title">送信メッセージ一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/message') }}">送信メッセージ一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>送信メッセージ一覧</h3>
            <div>
                <ul>
                    <li><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/message/create') }}'">新規作成</button></li>
                </ul>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>name</th>
                        <th>type</th>
                        <th>to</th>
                        <th>message objects</th>
                        <th>status</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach (($app->messages ?? array()) as $index => $message)
                        <tr>
                            <td>{{ $message->name  ??  null }}</td>
                            <td>{{ $message->get_type()  ??  null }}</td>
                            @switch($message->type)
                                @case("push")
                                @case("reply")
                                    <td>
                                        <ul>
                                            @foreach ($message->get_friends() as $friend)
                                                <li>{{ $friend->get_name() ?? null  }}</li>
                                            @endforeach
                                        </ul>
                                    @break
                                @case("narrowcast")
                                    <td></td>
                                    @break
                                @case("multicast")
                                @default
                                    <td></td>
                            @endswitch
                            <td>{{ count($message->messages ?? array()) }}</td>
                            <td>{{ $message->get_status() ?? null }}</td>
                            <td>{{ json_encode($message->error_messages) ?? null }}</td>

                            <td>{{ $message->datetime ?? null }}</td>
                            <td>{{ $message->sends->count() }}</td>
                            <td>{{ $message->sends->where("response_code",200)->count() }}</td>
                            <td>{{ $message->sends->where("response_code","!=",200)->count() }}</td>
                            <td><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/message/'.$message->id) }}'">{{ $message->status == "sent" ? "詳細" : "編集" }}</button></td>
                            <td>
                                @if ($message->status == "standby")
                                    <form action="{{ asset($user->name.'/app/'.$app->client_id.'/message/'.$message->id.'/send') }}" method="post">
                                        @csrf
                                        <button type="submit">送信</button>
                                    </form>
                                @endif
                            </td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>

