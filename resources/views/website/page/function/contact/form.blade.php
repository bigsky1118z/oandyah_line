<h2>{{ $page->title }}</h2>
<form action="{{ $page->name }}" method="post">
    @csrf
    <dl>
        <dt>名前</dt>
        <dd><input type="text" name="name" required></dd>
    </dl>
    <dl>
        <dt>メールアドレス</dt>
        <dd><input type="email" name="email" required></dd>
    </dl>
    <dl>
        <dt>お問い合わせ内容</dt>
        <dd><textarea name="content" cols="30" rows="10" required></textarea></dd>
    </dl>
    <dl>
        <dt>送信</dt>
        <dd><button type="submit">送信</button></dd>
    </dl>
    
</form>