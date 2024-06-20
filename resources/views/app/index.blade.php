<x-frame.web>
    <x-slot name="id">user</x-slot>
    <x-slot name="title">{{ $user->get_name() }}</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $user->get_name() }}</h2>
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
                        <td>{{ $app->app->name }}</td>
                        <td>{{ $app->app->display_name }}</td>
                        <td>{{ $app->role }}</td>
                        <td><a href="/{{ $user->name }}/app/{{ $app->app->name }}" target="_blank" rel="noopener noreferrer">アプリ管理画面</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>