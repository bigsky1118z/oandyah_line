<x-admin.api.line.frame.basic title="自動返信" heading="自動返信" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <h3>デフォルト返信メッセージ</h3>
    @if(isset($replies["default"]))
        @foreach ($replies["default"] as $reply)
            <dl class="dl-flex-left dl-dt-200px">
                <dd><input type="checkbox" id="checkbox-default-{{ $reply->id }}" value="{{ $reply->id }}" onchange="changeIsActive(this);" @checked($reply->active)></dd>
                <dt><label for="checkbox-default-{{ $reply->id }}">{{ $reply->name }}</label></dt>
                <dd>
                    <ul>
                        @foreach ($reply->line_api_messages() as $line_api_message)
                            <li>{{ $line_api_message->name }}</li>
                        @endforeach
                    </ul>
                </dd>
                <dd>{{ $reply->notification_disabled ? "非通知" : "通知" }}</dd>
                <dd>{{ $reply->valid_at }}</dd>
                <dd>{{ $reply->expired_at }}</dd>
                <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/postback/{{ $reply->id }}'">詳細</button></dd>
                <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/postback/{{ $reply->id }}/edit'">編集</button></dd>
            </dl>
        @endforeach
    @else
        <p>自動返信が設定されていません</p>
    @endif
</section>
<section>
    <h3>アクション一覧</h3>
    @foreach ($postback_action_names as $key => $value)
        @if ($key == "others")
            @continue
        @else
            <dl class="dl-flex-left dl-dt-120px">
                <dt>{{ $value }}</dt>
                <dd>{{ isset($replies[$key]) ? count($replies[$key]) : 0 }}件</dd>
                <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/postback/{{ $key }}'">詳細</button></dd>
            </dl>
        @endif
    @endforeach
</section>
<x-slot name="script">
    <x-admin.api.line.script.async-changeIsActive :channel="$channel" type="postback" />
</x-slot>
</x-admin.api.frame.basic>