<x-admin.api.line.frame.basic title="友達追加" heading="友達追加" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/follow/create'">新規メッセージ登録</button></dd>
</dl>
<dl class="dl-flex-left">
    <dt>自動返信の優先度</dt>
    <dd>
        <ol>
            <li>有効期間の開始と終了が設定されている返信</li>
            <li>有効期間の終了が設定されている返信</li>
            <li>有効期間の開始が設定されている返信</li>
            <li>有効期間が設定されていない返信</li>
            <li>デフォルト返信</li>
        </ol>   
    </dd>
    <dd>同順位が複数ある場合は作成日が新しい順</dd>
</dl>
@foreach (array("default","follow","refollow") as $condition)
    <section>
        <h3>{{ array("default"=>"デフォルト","follow"=>"新規追加","refollow"=>"ブロック解除")[$condition] }}挨拶メッセージ</h3>
        @if(isset($replies[$condition]))
            @foreach ($replies[$condition] as $reply)
                <dl class="dl-flex-left dl-dt-200px">
                    <dd><input type="checkbox" id="checkbox-{{ $condition }}-{{ $reply->id }}" value="{{ $reply->id }}" onchange="changeIsActive(this);" @checked($reply->active)></dd>
                    <dt><label for="checkbox-{{ $condition }}-{{ $reply->id }}">{{ $reply->name }}</label></dt>
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
                    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/follow/{{ $reply->id }}'">詳細</button></dd>
                    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/follow/{{ $reply->id }}/edit'">編集</button></dd>
                    <dd>@if($reply->condition!="default")<button onclick="window.confirm('削除しますか？') ? location.href='/api/line/{{ $channel->channel_name }}/reply/follow/{{ $reply->id }}/delete' : null;">削除</button>@endif</dd>

                </dl>
            @endforeach
        @else
            <p>挨拶メッセージが設定されていません</p>
        @endif
    </section>
@endforeach
<x-slot name="script">
    <x-admin.api.line.script.async-changeIsActive :channel="$channel" type="follow" />
</x-slot>
</x-admin.api.frame.basic>