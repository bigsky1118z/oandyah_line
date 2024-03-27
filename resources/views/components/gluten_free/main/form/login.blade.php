<h3>ユーザーログイン</h3>
<form action="/kbox" method="post">
    @csrf
    <dl id="dl-login-form">
        <dd>
            <dl class="dl-login-form-content">
                <dt class="dt-login-form-content-title">メールアドレス</dt>
                <dd class="dd-login-form-content-value"><input id="email" type="email" name="email" required></dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-login-form-content">
                <dt class="dt-login-form-content-title">パスワード</dt>
                <dd class="dd-login-form-content-value"><input id="password" type="password" name="password" required></dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-login-form-content">
                <dd class="dd-login-form-content-message">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">ログイン状態を保持する</label>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-login-form-content dl-login-form-footer">
                <dt class="dt-login-form-content-submit"><button type="submit">ログイン</button></dt>
                <dd class="dd-login-form-content-message"><a href="/forgot-password">パスワードを忘れた方はこちら</a></dd>
            </dl>
        </dd>

    </dl>
</form>