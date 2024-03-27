<x-admin.api.line.frame.basic title="友達情報" heading="友達情報" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user'">一覧</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/{{ $line_api_user->id }}/info'">更新</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/{{ $line_api_user->id }}/edit'">編集</button></dd>
</dl>
<section>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>管理者識別名</dt>
        <dd>{{ $line_api_user->name_to_identify }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>コミュニティ名</dt>
        <dd>{{ $line_api_user->registed_name }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>LINE登録名</dt>
        <dd>{{ $line_api_user->display_name }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>敬称</dt>
        <dd>{{ $line_api_user->honorific }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>LINE USER ID</dt>
        <dd>{{ $line_api_user->line_user_id }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>状態</dt>
        <dd>{{ $line_api_user->follow == "follow" ? "フォロー" : "フォロー解除" }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>言語</dt>
        <dd>{{ $line_api_user->language }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>LINE登録画像</dt>
        <dd>{!! isset($line_api_user->picture_url) ? "<img src='$line_api_user->picture_url' width='150px' height='150px'>" : null !!}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>LINEステータスメッセージ</dt>
        <dd>{{ $line_api_user->status_message }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-200px">
        <dt>メモ</dt>
        <dd>{{ $line_api_user->memo }}</dd>
    </dl>
</section>
</x-admin.api.line.frame.basic>