<x-frame.admin>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>ユーザー情報</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>メールアドレス</th>
                        <th>ユーザー名</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><input type="email" name="email" value="{{ $user->email }}"></td>
                        <td><input type="text" name="user_name" value="{{ $user->user_name }}"></td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <th>氏名</th>
                        <td>
                            <span>氏</span><input type="text" class="user_name" name="last_name" value="">
                            <span>名</span><input type="text" class="user_name" name="first_name" value="">
                        </td>
                    </tr>
                    <tr>
                        <th>氏名</th>
                        <td>
                            <span>氏</span><input type="text" class="user_name" name="last_name_kana" value="">
                            <span>名</span><input type="text" class="user_name" name="first_name_kana" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.admin>