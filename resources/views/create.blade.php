<x-frame.web>
    <x-slot name="title">新規登録 LINE公式アプリ応援屋</x-slot>
    <x-slot name="description">『LINE公式アプリ応援屋』の新規登録ページです</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <form action="/" action="post">
            @csrf
            <table>
                <tr>
                    <th>メールアドレス</th>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <th>パスワード</th>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <th>パスワード</th>
                    <td><input type="password" name="password_confirm" required></td>
                </tr>
                <tr>
                    <th>ユーザー名</th>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <th>生年月日</th>
                    <td><input type="date" name="birthday" required></td>
                </tr>
                {{-- 利用規約 --}}
                <tr>
                    <td colspan="2"><button type="submit">登録</button></td>
                </tr>
            </table>
        </form>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>