<x-line.frame.basic>
<x-slot name="id">index</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="description"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
<x-slot name="header"></x-slot>
@auth
    <section id="index">
        <h2>ようこそ、{{ $user->name ? $user->name->nickname() : $user->email }}さん</h2>
        <dl id="dl-line-index">
            <dt class="dt-line-index-header">
                <dl>
                    <dd class="dd-line-index-group">
                        <dl class="dl-line-index-group-0">
                            <dd class="dd-line-index-piture">アイコン</dd>
                        </dl>
                        <dl class="dl-line-index-group-1">
                            <dd class="dd-line-index-name">名前</dd>
                            <dd class="dd-line-index-display_name">タイトル</dd>
                        </dl>
                        {{-- <dl class="dl-line-index-group-2">
                            <dd class="dd-line-index-count">登録</dd>
                        </dl> --}}
                        <dl class="dl-line-index-group-button">
                            <dd class="dd-line-index-button">操作</dd>
                        </dl>
                    </dd>
                </dl>
            </dt>
            <dd class="dd-line-index-body">
                <dl>
                    @if ($lines->count())
                        @foreach ($lines as $line)
                            <dd class="dd-line-index-group">
                                <dl class="dl-line-index-group-0">
                                    <dd class="dd-line-index-picture"><img src="{{ $line->picture_url }}" width="50" height="50"></dd>
                                </dl>
                                <dl class="dl-line-index-group-1">
                                    <dd class="dd-line-index-name">{{ $line->name }}</dd>
                                    <dd class="dd-line-index-display_name">{{ $line->display_name }}</dd>
                                </dl>
                                <dl class="dl-line-index-group-2">
                                    <dd class="dd-line-index-count">{{ $line->get_bot_insight_followers()["targetedReaches"] }}</dd>
                                </dl>
                                <dl class="dl-line-index-group-button">
                                    <dd>
                                        <button type="button" onclick="location.href = '/line/{{ $line->name }}'">確認</button>
                                    </dd>
                                    <dd>
                                        <button type="button" onclick="location.href = '/line/{{ $line->name }}/delete'">削除</button>
                                    </dd>
                                </dl>
                            </dd>
                        @endforeach
                    @else
                        <dd class="dd-line-index-group">現在登録されていません</dd>
                    @endif
                </dl>
            </dd>
            <dd class="dd-line-index-footer">
                <dl>
                    <dd class="dd-line-index-group">
                        <button onclick="location.href='/line/create'">新規作成</button></dd>
                    </dd>
                </dl>
            </dd>
        </dl>
    </section>
@endauth
@guest
    <section id="login">
        <h2>ユーザーログイン</h2>
        <form action="/line/login" method="post">
            @csrf
            <dl id="dl-line-login">
                <dt>
                    <dl class="dl-line-login-header">
                    </dl>
                </dt>
                <dd>
                    <dl class="dl-line-login-body">
                        <dt class="dt-line-login-title">メールアドレス</dt>
                        <dd class="dd-line-login-value"><input id="email" type="email" name="email" required></dd>
                    </dl>
                    <dl class="dl-line-login-body">
                        <dt class="dt-line-login-title">パスワード</dt>
                        <dd class="dd-line-login-value"><input id="password" type="password" name="password" required></dd>
                    </dl>
                    <dl class="dl-line-login-body">
                        <dd class="dd-line-login-message">
                            <input id="remember_me" type="checkbox" name="remember">
                            <label for="remember_me">ログイン状態を保持する</label>
                        </dd>
                    </dl>
                </dd>
                <dd>
                    <dl class="dl-line-login-footer">
                        <dd class="dd-line-login-message">
                            <button type="submit">ログイン</button>
                        </dd>
                    </dl>
                    <dl class="dl-line-login-footer">
                        <dd class="dd-line-login-message">
                            <a href="/forgot-password">パスワードを忘れた方はこちら</a>
                            <button type="button" onclick="location.href='/line/regist'">新規登録</button>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </form>
    </section>
@endguest
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-line.frame.basic>