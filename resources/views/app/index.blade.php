<x-frame.web>
    <x-slot name="id">user-app</x-slot>
    <x-slot name="title">{{ $user->get_name() }}さんのアプリ一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name . '/app') }}">アプリ一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $user->get_name() }}さんのアプリ一覧</h2>
        <table>
            <thead>
                <tr>
                    <th>アプリID</th>
                    <th>アプリ名</th>
                    <th>権限</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->apps as $app)
                    <tr>
                        <td>{{ $app->app->client_id }}</td>
                        <td>{{ $app->app->display_name }}</td>
                        <td>{{ $app->role }}</td>
                        <td><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->app->client_id) }}'">アプリ管理画面</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>