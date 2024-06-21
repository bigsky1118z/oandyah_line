<x-frame.admin>
    <x-slot name="id">admin-user-index</x-slot>
    <x-slot name="title">ユーザー</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset('admin' . '/user') }}">ユーザー</a></li>
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>ユーザー一覧</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>birthday</th>
                        <th>apps</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birthday->format("Y-m-d") }}</td>
                            <td>
                                <ul>
                                    @foreach ($user->apps as $app)
                                        <li>{{ $app->app->display_name }}[{{ $app->role }}]</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td><a href="/admin/user/{{ $user->id }}">詳細</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.admin>