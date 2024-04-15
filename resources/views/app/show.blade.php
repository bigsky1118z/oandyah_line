<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->diplay_name ?? $app->name }}</h2>
        <h3>アプリ情報</h3>
        <form action="/{{ $user->name }}/app/{{ $app->name }}" method="post">
            @csrf
            <p>現在の権限 {{ $role }}</p>
            <table>
                <tr>
                    <th>アプリID</th>
                    <td>
                        @switch($role)
                            @case("admin")
                                <input type="text" name="name" value="{{ $app->name }}">
                                @break
                            @case("editor")
                            @default
                                {{ $app->name }}
                                @break
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <th>endpoint</th>
                    <td>{{ $app->get_bot_channel_webhook_endpoint()["endpoint"] ?? null }}</td>
                </tr>
                <tr>
                    <th>channel_access_token</th>
                    <td>
                        @switch($role)
                            @case("admin")
                                <textarea name="channel_access_token" cols="40" rows="5" readonly>{{ $app->channel_access_token }}</textarea>
                                <input type="checkbox" id="checkbox_channel_access_token" onchange="document.querySelector('textarea[name=channel_access_token]').readOnly = this.checked" checked>
                                <label for="checkbox_channel_access_token">保護</label>
                                @break
                            @case("editor")
                            @default
                                {{ $app->channel_access_token }}
                                @break
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <th>user_id</th>
                    <td>{{ $app->user_id }}</td>
                </tr>
                <tr>
                    <th>basic_id</th>
                    <td>{{ $app->basic_id }}</td>
                </tr>
                <tr>
                    <th>表示名</th>
                    <td>{{ $app->display_name }}</td>
                </tr>
                <tr>
                    <th>picture_url</th>
                    <td>
                        <dl>
                            <dt><img src="{{ $app->picture_url }}" alt=""></dt>
                            @switch($role)
                                @case("admin")
                                @case("editor")
                                    <dd>
                                        <input type="file" name="picture_url" value="{{ $app->picture_url }}">
                                        <button type="button">画像変更</button>
                                    </dd>
                                    @break
                                @default
                                    <dd></dd>
                                    @break
                            @endswitch
                        </dl>
                    </td>
                </tr>
                <tr>
                    <th>chat_mode</th>
                    <td>{{ $app->chat_mode }}</td>
                </tr>
                <tr>
                    <th>mark_as_read_mode</th>
                    <td>{{ $app->mark_as_read_mode }}</td>
                </tr>
            </table>
            <button type="submit">post</button>
        </form>
        <h3><a href="/{{ $user->name }}/app/{{ $app->name }}/webhook">webhook情報</a></h3>
        <ul>
            @foreach ($app->webhooks as $webhook)
                <li>{{ $webhook->type }}</li>
            @endforeach
        </ul>
        <h3><a href="/{{ $user->name }}/app/{{ $app->name }}/friend">友だち情報</a></h3>
        <ul>
            @foreach ($app->friends as $friend)
                <li>{{ $friend->display_name }}</li>
            @endforeach
        </ul>
        <h3><a href="/{{ $user->name }}/app/{{ $app->name }}/message">メッセ―ジ情報</a></h3>
        <ul>
            @foreach ($app->messages as $message)
                <li>{{ $message->display_name }}</li>
            @endforeach
        </ul>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>