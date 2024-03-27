<x-admin.api.line.frame.basic title="{{ $channel->channel_display_name }} トップメニュー" heading="{{ $channel->channel_display_name }}トップメニュー" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <h3>チャンネル情報</h3>
    <dl class="dl-flex-left dl-dt-150px">
        <dt>チャンネル名</dt>
        <dd>{{ $channel->display_name }}</dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/info'">情報更新</button></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-150px">
        <dt>代表者</dt>
        <dd>{{ $channel->bot_user_id }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-150px">
        <dt>Webhook URL</dt>
        <dd>{{ $channel->get_endpoint()->status() == 200 ? $channel->get_endpoint()["endpoint"] : "エラー" }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-150px">
        <dt>ベーシックID</dt>
        <dd>{{ $channel->basic_id }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-150px">
        <dt>プレミアムID</dt>
        <dd>{{ $channel->premium_id ? $channel->premium_id : "設定なし" }}</dd>
    </dl>
    {{-- <dl class="dl-flex-left dl-dt-150px">
        <dt>チャットモード</dt>
        <dd>{{ $channel->chat_mode ? $channel->chat_mode : "設定なし" }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-150px">
        <dt>リードモード</dt>
        <dd>{{ $channel->mark_as_read_mode ? $channel->mark_as_read_mode : "設定なし" }}</dd>
    </dl> --}}
    <dl class="dl-flex-left dl-dt-150px">
        <dt>アイコン画像</dt>
        <dd>{!! $channel->picture_url ? "<img src='$channel->picture_url' width='60' height='auto'>" : null !!}</dd>
    </dl>
</section>
<section>
    <h3>友達情報</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>受信メッセージ</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/receive'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>送信メッセージ</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/send'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>自動送信メッセージ</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>画像</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/image'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>作成済みメッセージ</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/message'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>リッチメニュー</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/richmenu'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>オーダー</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/order'">詳細</button></dd>
    </dl>
</section>
<section>
    <h3>イベント</h3>
    <dl class="dl-flex-left">
        <dt></dt>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event'">詳細</button></dd>
    </dl>
</section>

</x-admin.api.line.frame.basic>