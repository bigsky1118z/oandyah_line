<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>アプリ登録</h2>
        <form action="/{{ $user->name }}/app" method="post">
            @csrf
            <table>
                <tr>
                    <th>アプリID</th>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <th>チャネルアクセストークン</th>
                    <td>
                        <textarea name="channel_access_token" cols="50" rows="5" required></textarea>
                        <p>チャンネルアクセストークンの取得方法は<a href="#">こちら</a></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">登録</button></td>
                </tr>
            </table>
        </form>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>