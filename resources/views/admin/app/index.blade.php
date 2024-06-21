<x-frame.admin>
    <x-slot name="id">admin-app-index</x-slot>
    <x-slot name="title">アプリ</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset('admin' . '/app') }}">アプリ</a></li>
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>アプリ一覧</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>client_id</th>
                        <th>display_name</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($apps as $app)
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td>{{ $app->client_id }}</td>
                            <td>{{ $app->display_name }}</td>
                            <td>
                                @foreach ($app->users as $user)
                                    <span>{{ $user->user->get_name() }}</span>
                                @endforeach
                            </td>
                            <td><a href="/admin/app/{{ $app->id }}">詳細</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.admin>