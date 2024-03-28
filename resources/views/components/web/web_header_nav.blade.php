<nav id="header-nav">
    <ul id="header-nav-ul">
        <li><a href="/">TOP</a></li>
        <li>メニュー1</li>
        <li>メニュー2</li>
        @auth
            <li><a href="{{ auth()->user()->user_name }}">マイページ</a></li>
            <li>
                <form action="logout" method="post" style="cursor: pointer">
                    @csrf
                    <span onclick="this.closest('form').submit();">ログアウト</span>
                </form>
            </li>
        @endauth
        @guest
            <li><a href="register">会員登録</a></li>
            <li><a href="login">ログイン</a></li>
        @endguest
</ul>
</nav>
