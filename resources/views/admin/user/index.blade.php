<x-frame.top>
    <x-slot name="title">[管理画面]LINE公式アプリ応援屋</x-slot>
    {{-- <x-slot name="description">『LINE公式アプリ応援屋』はLINE Messaging APIを簡単に利用できるようにするサービスです</x-slot> --}}
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
        <nav id="header-nav">
            <ul id="header-nav-ul">
                <li>メニュー1</li>
                <li>メニュー2</li>
                <li>メニュー3</li>
                <li>メニュー4</li>
            </ul>
        </nav>
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>user</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>email</th>
                        <th>user name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td><a href="/admin/user/{{ $user->id }}">詳細</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.top>