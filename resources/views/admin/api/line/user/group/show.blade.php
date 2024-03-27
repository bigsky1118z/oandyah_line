<x-admin.api.line.frame.basic title="ユーザーグループ" heading="ユーザーグループ" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    {{-- <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/create'">手動追加</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/info'">一斉更新</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/csv/export'">CSVエクスポート</button></dd> --}}
</dl>
<section>
    <h3>グループ詳細</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>グループ名</dt>
        <dd>{{ $line_api_user_group->name }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>概要</dt>
        <dd>{{ $line_api_user_group->description }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>ランク</dt>
        <dd>{{ $line_api_user_group->rank }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>有効</dt>
        <dd>{{ $line_api_user_group->active ? "有効" : "無効" }}</dd>
    </dl>
</section>
<section>
    <h3>ユーザー一覧</h3>
    @foreach ($line_api_user_group->line_api_users as $item)
    <dl class="dl-flex-left dl-dt-120px">
        <dt>{{ $item->line_api_user->nickname() }}</dt>
    </dl>        
    @endforeach
</section>
</x-admin.api.line.frame.basic>