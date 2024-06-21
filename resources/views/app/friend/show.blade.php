<x-frame.web>
    <x-slot name="id">user-app-friend-show</x-slot>
    <x-slot name="title">{{ $app->display_name ?? $app->client_id }}の友だち一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id ) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/friend' ) }}">友だち一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/friend/'.$friend->friend_id ) }}">{{ $friend->get_name() }}</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name ?? $app->client_id }}</h2>
        <section>
            <h3>友だちの情報</h3>
            <table>
                <tr>
                    <th>ステータス</th>
                    <td>{{ $friend->status }}</td>
                </tr>
                <tr>
                    <th>表示名</th>
                    <td>{{ $friend->display_name }}</td>
                </tr>
                <tr>
                    <th>アイコン</th>
                    <td><img src="{{ $friend->picture_url }}" alt="" width="100" height="auto"></td>
                </tr>
                <tr>
                    <th>メッセージ</th>
                    <td>{{ $friend->status_message }}</td>
                </tr>
                <tr>
                    <th>友だち追加日</th>
                    <td>{{ $friend->created_at }}</td>
                </tr>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>