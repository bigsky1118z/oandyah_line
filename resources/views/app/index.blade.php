<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>ユーザーページ - TOP</h2>
        <table>
            <thead>
                <tr>
                    <th>APP ID</th>
                    <th>APPタイトル</th>
                    <th>操作</th>
                </tr>
            </thead>
            @foreach ($user->apps as $app)
                <tr>
                    <td>{{ $app->app_name }}</td>
                    <td>{{ $app->display_name }}</td>
                    <td><a href="/{{ $user->user_name }}/{{ $app->app_name }}" target="_blank" rel="noopener noreferrer">アプリ</a></td>
                </tr>
            @endforeach
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>