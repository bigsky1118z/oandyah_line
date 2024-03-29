<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>ユーザーページ - TOP</h2>
        <h3><a href="/{{ $user->name }}/app">アプリ一覧</a></h3>
        <ul>
            @foreach ($user->apps as $app)
                <li><a href="/{{ $user->name }}/app/{{ $app->name }}" target="_blank" rel="noopener noreferrer">{{ $app->app->display_name ?? $app->app->name }}</a></li>
            @endforeach
        </ul>
        <h3><a href="/{{ $user->name }}/news">お知らせ一覧</a></h3>
        <ul>
            @for ($i = 0; $i < 5; $i++)
                <li>
                    <a href="/{{ $user->name }}/news/{{ $i }}">
                        <dl>
                            <dt>お知らせ{{ $i }}</dt>
                            <dd>お知らせをここに通知します</dd>
                        </dl>
                    </a>
                </li>
            @endforeach
        </ul>
        <h3><a href="/{{ $user->name }}/message">メッセージボックス</a></h3>
        <ul>
            @for ($i = 0; $i < 5; $i++)
                <li>
                    <a href="/{{ $user->name }}/message/{{ $i }}">
                        <dl>
                            <dt>メッセージ{{ $i }}</dt>
                            <dd>メッセージをここに通知します</dd>
                        </dl>
                    </a>
                </li>
            @endforeach
        </ul>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>