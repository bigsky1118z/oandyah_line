<x-frame.web>
    <x-slot name="id">user-app-create</x-slot>
    <x-slot name="title">{{ $user->get_name() }}さんのアプリ一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name . '/app') }}">アプリ一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>アプリ登録</h2>
        <form action="{{ asset($user->name.'/app') }}" method="post">
            @csrf
            <ul>
                {{ $errors }}
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <table>
                <tr>
                    <th>チャネルアクセストークン</th>
                    <td>
                        <textarea name="channel_access_token" cols="50" rows="5" required>{{ old("channel_access_token") ?? null }}</textarea>
                        <p>チャンネルアクセストークンの取得方法は<a href="#">こちら</a></p>
                    </td>
                </tr>
                <tr>
                    <th>チャネルシークレット</th>
                    <td>
                        <input type="text" name="channel_secret" value="{{ old("channel_secret") }}" required></textarea>
                        <p>チャンネルシークレットの取得方法は<a href="#">こちら</a></p>
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