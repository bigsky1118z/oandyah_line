<h3>スプレッドを選択してください</h3>
<dl id="dl-spreads">
    @foreach ($spreads as $spread)
        <dd><a href="/jinguji_ozora/tarot/{{ $spread["name"] }}">{{ $spread["title"] }}リーディング</a></dd>
    @endforeach
    <dd><a href="/jinguji_ozora/tarot/all" class="tarot-card-all">タロットカード一覧</a></dd>

</dl>