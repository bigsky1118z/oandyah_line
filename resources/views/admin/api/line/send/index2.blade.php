<x-admin.api.line.frame.basic title="送信メッセージ" heading="送信メッセージ" :channel="$channel">
<x-slot name="head">
</x-slot>
<div class="div-dl-dt-150px">
    <dl class="dl-flex-left">
        <dt>今月の送信件数</dt>
        <dd>{{ $quota_consumption['totalUsage'] }}</dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>今月の送信上限</dt>
        <dd>{{ $quota['value'] }}</dd>
    </dl>
</div>
<h3>メッセージ作成</h3>
<h4>新規メッセージ作成</h4>
<p><a href="/api/line/{{ $channel->channel_name }}/send/create">new message</a></p>
<h4>個別チャットページ</h4>
<p><a href="{{ $channel->get_chat_url() }}" target="_blank" rel="noopener noreferrer">chat page</a></a></p>
<h3>メッセージ確認</h3>
{{-- @if (!$error->isEmpty())
<h4>送信エラー</h4>
<x-admin.api.line.parts.index.send-table type="error" :sends="$error" />
@endif
@if (!$draft->isEmpty())
<h4>下書き</h4>
<x-admin.api.line.parts.index.send-table type="draft" :sends="$draft" />
@endif
<h4>送信予約</h4>
<x-admin.api.line.parts.index.send-table type="reserve" :sends="$reserve" /> --}}
<h4>送信済み</h4>
@foreach ($sent as $send)
<dl class="dl-flex-left">
    <dd>
        <ul>
            <li>{{ $send->created_at }}</li>
            <li>{{ $send->updated_at }}</li>
            <li>{{ $send->schedule_at }}</li>
            <li>{{ $send->sent_at }}</li>
        </ul>
    </dd>
    <dd>{{ $send->user->nickname() }}</dd>
    <dd>
        <ul>
            @foreach ($send->get_messages() as $message)
                <li>{{ $message["text"] }}</li>
            @endforeach
        </ul>
    </dd>
</dl>
@endforeach

{{-- <x-admin.api.line.parts.index.send-table type="sent" :sends="$sent" /> --}}
</x-admin.api.line.frame.basic>