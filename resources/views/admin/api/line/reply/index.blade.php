<x-admin.api.line.frame.basic title="自動返信" heading="自動返信" :channel="$channel">
<x-slot name="head">
</x-slot>
@foreach (array("follow", "message", "postback") as $type)
    <section>
        <h3>{{ array("follow"=>"フォロー","message"=>"メッセージ","postback"=>"ポストバック")[$type] }}に対する自動返信</h3>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>有効な自動返信</dt>
            <dd>{{ isset($replies[$type]) ? count($replies[$type]) : 0 }}件</dd>
            <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/{{ $type }}'">詳細</button></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>デフォルト自動返信</dt>
            <dd>{{ isset($replies[$type]) && $replies[$type]->where("condition","default")->isNotEmpty() ? "設定あり" : "設定なし" }}</dd>
        </dl>
    </section>
@endforeach
</x-admin.api.line.frame.basic>