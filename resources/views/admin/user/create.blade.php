<x-frame.admin>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>user</h2>
            <table>
                <tbody>
                    <tr>
                        <th>id</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td><input type="email" name="email" value="{{ $user->email }}"></td>
                    </tr>
                    <tr>
                        <th>user name</th>
                        <td><input type="text" name="user_name" value="{{ $user->user_name }}"></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.admin>