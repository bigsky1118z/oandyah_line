<x-sns.frame.basic>
<x-slot name="id">index</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="description"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
<x-slot name="header"></x-slot>
@auth
    <section id="index">
        <h2>ようこそ、{{ $user->name ? $user->name->nickname() : $user->email }}さん</h2>
        <dl id="dl-sns-index">
            <dt class="dt-sns-index-header">
                <dl>
                    <dd class="dd-sns-index-group">
                        <dl class="dl-sns-index-group-0">
                            <dd class="dd-sns-index-icon">アイコン</dd>
                            <dd class="dd-sns-index-name">名前</dd>
                        </dl>                        
                        <dl class="dl-sns-index-group-1">
                            <dd class="dd-sns-index-title">タイトル</dd>
                            <dd class="dd-sns-index-description">概要</dd>
                        </dl>
                        {{-- <dl class="dl-sns-index-group-2">
                            <dd class="dd-sns-index-count">登録</dd>
                        </dl>                         --}}
                        <dl class="dl-sns-index-group-button">
                            <dd class="dd-sns-index-button">操作</dd>
                        </dl>
                    </dd>
                </dl>
            </dt>
            <dd class="dd-sns-index-body">
                <dl>
                    @if ($snss->count())
                        @foreach ($snss as $sns)
                            <dd class="dd-sns-index-group">
                                <dl class="dl-sns-index-group-0">
                                    <dd class="dd-sns-index-icon"><img id="img-sns-icon" src="{{ $sns->image_url_icon() }}"></dd>
                                    <dd class="dd-sns-index-name">{{ $sns->name }}</dd>
                                </dl>                        
                                <dl class="dl-sns-index-group-1">
                                    <dd class="dd-sns-index-title">{{ $sns->title }}</dd>
                                    <dd class="dd-sns-index-description">{{ $sns->description }}</dd>
                                </dl>                        
                                {{-- <dl class="dl-sns-index-group-2">
                                    <dd class="dd-sns-index-active">{{ $sns->links()->whereActive(true)->count() }}</dd>
                                    <dd class="dd-sns-index-count">{{ $sns->links->count() }}</dd>
                                </dl>                         --}}
                                <dl class="dl-sns-index-group-button">
                                    <dd>
                                        <button type="button" onclick="location.href = '/sns/{{ $sns->name }}'">確認</button>
                                    </dd>
                                    <dd>
                                        <button type="button" onclick="location.href = '/sns/{{ $sns->name }}/delete'">削除</button>
                                    </dd>
                                </dl>
                            </dd>
                        @endforeach
                    @else
                        <dd class="dd-sns-index-group">現在登録されていません</dd>
                    @endif
                </dl>
            </dd>
            <dd class="dd-sns-index-footer">
                <dl>
                    <dd class="dd-sns-index-group">
                        <button onclick="location.href='/sns/create'">新規作成</button></dd>
                    </dd>
                </dl>
            </dd>
        </dl>
    </section>
@endauth
@guest
    <section id="login">
        <h2>ユーザーログイン</h2>
        <form action="/sns/login" method="post">
            @csrf
            <dl id="dl-sns-login">
                <dt>
                    <dl class="dl-sns-login-header">
                    </dl>
                </dt>
                <dd>
                    <dl class="dl-sns-login-body">
                        <dt class="dt-sns-login-title">メールアドレス</dt>
                        <dd class="dd-sns-login-value"><input id="email" type="email" name="email" required></dd>
                    </dl>
                    <dl class="dl-sns-login-body">
                        <dt class="dt-sns-login-title">パスワード</dt>
                        <dd class="dd-sns-login-value"><input id="password" type="password" name="password" required></dd>
                    </dl>
                    <dl class="dl-sns-login-body">
                        <dd class="dd-sns-login-message">
                            <input id="remember_me" type="checkbox" name="remember">
                            <label for="remember_me">ログイン状態を保持する</label>
                        </dd>
                    </dl>
                </dd>
                <dd>
                    <dl class="dl-sns-login-footer">
                        <dd class="dd-sns-login-message">
                            <button type="submit">ログイン</button>
                        </dd>
                    </dl>
                    <dl class="dl-sns-login-footer">
                        <dd class="dd-sns-login-message">
                            <a href="/forgot-password">パスワードを忘れた方はこちら</a>
                            <button type="button" onclick="location.href='/sns/regist'">新規登録</button>
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
</x-sns.frame.basic>