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
                        <th>タイトル</th>
                        <th>送信方法</th>
                        <th>送信先</th>
                        <th>メッセージ数</th>
                        <th>ステータス</th>
                        <th>送信日時（予定）</th>
                        <th colspan="2">操作</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach (($app->messages ?? array()) as $index => $message)
                        <tr>
                            <td>{{ $message->name  ??  null }}</td>
                            <td>{{ $message->get_type()  ??  null }}</td>
                            <td>
                                @switch($message->type)
                                    @case("push")
                                    @case("reply")
                                        <ul>
                                            @foreach ($message->get_friends() as $friend)
                                                <li>{{ $friend->get_name() ?? null  }}</li>
                                            @endforeach
                                        </ul>
                                        @break
                                    @case("narrowcast")
                                        @break
                                    @case("multicast")
                                    @default
                                @endswitch
                            </td>
                            <td>{{ count($message->messages ?? array()) }} / 5</td>
                            <td>{{ $message->get_status() ?? null }}</td>
                            <td>
                                @switch($message->status)
                                    @case("sent")
                                    @case("reserved")
                                    @case("standby")
                                        {{ $message->datetime ?? null }}
                                        @break
                                    @case("draft")
                                        <ul>
                                            @foreach (($message->error_details ?? array()) as $error)
                                                <li>{{ $error["property"] ?? null }}:{{ $error["message"] ?? null }}</li>
                                            @endforeach
                                        </ul>
                                        @break
                                    @default
                                        
                                @endswitch
                            </td>
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

