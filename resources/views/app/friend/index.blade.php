<x-frame.web>
    <x-slot name="id">user-app-friend-index</x-slot>
    <x-slot name="title">{{ $app->display_name ?? $app->client_id }}の友だち一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id ) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/friend' ) }}">友だち一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name ?? $app->client_id }}</h2>
        <section>
            <h3>友だち一覧</h3>
            <table>
                <thead>
                    <tr>
                        <th>アイコン</th>
                        <th>LINE表示名</th>
                        <th>登録名</th>
                        <th>ステータス</th>
                        <th>操作</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach ($app->friends as $friend)
                        <tr>
                            <td><img src="{{ $friend->picture_url }}" alt="" width="50px" height="50px"></td>
                            <td>{{ $friend->display_name }}</td>
                            <td>{{ $friend->friend_id }}</td>
                            <td>{{ $friend->status }}</td>
                            <td><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/friend/'.$friend->friend_id) }}'">詳細</button></td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>