<x-frame.admin>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>ユーザー一覧</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>email</th>
                        <th>user name</th>
                        <th>birthday</th>
                        <th>apps</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->birthday }}</td>
                            <td>
                                <ul>
                                    @foreach ($user->apps as $app)
                                        <li>{{ $app->app->name }}[{{ $app->role }}]</li>
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