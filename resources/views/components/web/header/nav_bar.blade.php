<nav id="header-nav-bar">
    <ul id="header-nav-bar-ul">
        <li><a href="/">TOP</a></li>
        <li>メニュー1</li>
        @auth
            <li><a href="{{ asset(auth()->user()->name) }}">マイページ</a></li>
            <li>
                <form action="{{ asset("logout") }}" method="post" style="cursor: pointer">
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
