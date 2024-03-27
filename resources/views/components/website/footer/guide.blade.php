<div id="footer-guide">
    <dl>
        @auth
            @if (auth()->user()->is_admin())
                <dd><span onclick="location.href='/edit'">edit</span></dd>
            @endif
            <dd>
                <form action="/logout" method="post">
                    @csrf
                    <span onclick="this.closest('form').submit();">logout</span>
                </form>
            </dd>
        @endauth
        <dd><span onclick="location.href='#'">page top</span></dd>
        <dd><span onclick="location.href='/'">home</span></dd>
    </dl>
</div>
