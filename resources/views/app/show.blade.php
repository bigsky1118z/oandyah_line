<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->diplay_name ?? $app->name }}</h2>
        <h3>insight</h3>
        {{ $app->get_insight_message_delivery() }}
        <h3>アプリ情報</h3>
        <form action="/{{ $user->name }}/app/{{ $app->name }}" method="post">
            @csrf
            <p>現在の権限 {{ $role }}</p>
            <table>
                <tr>
                    <th>name</th>
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
                    <th>channel_access_token</th>
                    <td>
                        @switch($role)
                            @case("admin")
                                <textarea name="channel_access_token" cols="50" rows="5">{{ $app->channel_access_token }}</textarea>
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
                    <th>display_name</th>
                    <td>
                        @switch($role)
                            @case("admin")
                            @case("editor")
                                <input type="text" name="display_name" value="{{ $app->display_name }}">
                                @break
                            @default
                                {{ $app->display_name }}
                                @break
                        @endswitch
                    </td>
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
        <h4></h4>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>