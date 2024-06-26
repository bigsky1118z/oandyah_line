<x-frame.web>
    <x-slot name="id">user</x-slot>
    <x-slot name="title">{{ $user->get_name() ?? null }}さんのマイページ</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $user->get_name() ?? null }}さんのマイページ</h2>
        <section>
            <h3>設定</h3>
            <table>
                <tbody>
                    <tr>
                        <th>ユーザー名</th>
                        <td colspan="2">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td colspan="2">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>誕生日</th>
                        <td colspan="2">{{ $user->birthday->format("Y-m-d") }}</td>
                    </tr>
                    <tr>
                        <th>名前</th>
                        <td>{{ $user->get_config("last_name")->value ?? null }}</td>
                        <td>{{ $user->get_config("first_name")->value ?? null }}</td>
                    </tr>
                    <tr>
                        <th>カナ</th>
                        <td>{{ $user->get_config("last_name_kana")->value ?? null }}</td>
                        <td>{{ $user->get_config("first_name_kana")->value ?? null }}</td>
                    </tr>
                    <tr>
                        <th>ニックネーム</th>
                        <td colspan="2">{{ $user->get_config("nickname")->value ?? null }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <h3><a href="{{ asset($user->name . '/app') }}">アプリ一覧</a></h3>
        <ul style="display: flex;">
            @foreach ($user->apps as $app)
                <li>
                    <a href="{{ asset( $user->name.'/app/'.$app->app->client_id) }}" target="_blank" rel="noopener noreferrer">
                        <dl>
                            <dd><img src="{{ $app->app->picture_url ?? null }}" alt="{{ $app->app->display_name ?? "no image" }}" width="100" height="auto"></dd>
                            <dt>{{ $app->app->display_name ?? $app->app->client_id }}</dt>
                        </dl>    
                    </a>
                </li>
            @endforeach
        </ul>
        <h3><a href="/{{ $user->name }}/news">お知らせ一覧</a></h3>
        {{-- <ul>
            @for ($i = 0; $i < 5; $i++)
                <li>
                    <a href="/{{ $user->name }}/news/{{ $i }}">
                        <dl>
                            <dt>お知らせ{{ $i }}</dt>
                            <dd>お知らせをここに通知します</dd>
                        </dl>
                    </a>
                </li>
            @endfor
        </ul> --}}
        <h3><a href="/{{ $user->name }}/message">メッセージボックス</a></h3>
        {{-- <ul>
            @for ($i = 0; $i < 5; $i++)
                <li>
                    <a href="/{{ $user->name }}/message/{{ $i }}">
                        <dl>
                            <dt>メッセージ{{ $i }}</dt>
                            <dd>メッセージをここに通知します</dd>
                        </dl>
                    </a>
                </li>
            @endfor
        </ul> --}}
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>