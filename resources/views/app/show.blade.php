<x-frame.web>
    <x-slot name="id">user-app-show</x-slot>
    <x-slot name="title">{{ $app->display_name ?? $app->client_id }}詳細</x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id ) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name ?? $app->client_id }}</h2>
        <section>
            <h3>アプリ</h3>
                <table>
                    <tr>
                        <th>アプリ権限</th>
                        <td>{{ $role }}</td>
                    </tr>
                    <tr>
                        <th>アプリID</th>
                        <td>{{ $app->client_id }}</td>
                    </tr>
                    <tr>
                        <th>チャンネルアクセストークン</th>
                        <td>{{ $app->verify_channel_access_token()->successful() ? "有効" : "無効" }}</td>
                    </tr>
                    <tr>
                        <th>ユーザーID</th>
                        <td>{{ $app->user_id }}</td>
                    </tr>
                    <tr>
                        <th>検索ID</th>
                        <td>{{ $app->basic_id }}</td>
                    </tr>
                    <tr>
                        <th>表示名</th>
                        <td>{{ $app->display_name }}</td>
                    </tr>
                    <tr>
                        <th>アイコン</th>
                        <td>
                            <dl>
                                <dt><img src="{{ $app->picture_url }}" alt="" width="100px" height="auto"></dt>
                            </dl>
                        </td>
                    </tr>
                    <tr>
                        <th>チャットモード</th>
                        <td>{{ $app->get_chat_mode() }}</td>
                    </tr>
                    <tr>
                        <th>自動既読設定</th>
                        <td>{{ $app->get_mark_as_read_mode() }}</td>
                    </tr>
                </table>
        </section>
        <section id="webhook">
            <h3><a href="{{ asset($user->name."/app/".$app->client_id."/webhook") }}">webhook</a></h3>
            <div>
                <ul>
                    @foreach ($app->webhooks as $webhook)
                        <li>{{ $webhook->type }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
        <section id="friend">
            <h3><a href="{{ asset($user->name."/app/".$app->client_id."/friend") }}">友だち</a></h3>
            <div></div>
        </section>
        <section id="reply">
            <h3><a href="{{ asset($user->name."/app/".$app->client_id."/reply") }}">自動返信</a></h3>
            <div></div>
        </section>
        <section id="send">
            <h3><a href="{{ asset($user->name."/app/".$app->client_id."/send") }}">送信</a></h3>
            <div></div>
        </section>
        <section id="richmenu">
            <h3><a href="{{ asset($user->name."/app/".$app->client_id."/richmenu") }}">リッチメニュー</a></h3>
            <div></div>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>