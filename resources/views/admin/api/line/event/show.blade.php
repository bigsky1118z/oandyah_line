<x-admin.api.line.frame.basic title="{{ $event_name }} [イベント]" heading="{{ $event_name }} [イベント]" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <h3>{{ $event->event_name }} {{ $event->schedule_name }}</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>タイトル</dt>
        <dd>{{ $event->event_name }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>イベント名</dt>
        <dd>{{ $event->schedule_name }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>概要</dt>
        <dd>{{ $event->discription }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>カテゴリ</dt>
        <dd>{{ $event->category }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>サブカテゴリ</dt>
        <dd>{{ $event->sub_category }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>ステータス</dt>
        <dd>{{ $event->status }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>主催</dt>
        <dd>{{ $event->organizer }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>場所</dt>
        <dd>{{ $event->place }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>住所</dt>
        <dd>{{ $event->address }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>値段</dt>
        <dd>{{ $event->price }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>開場</dt>
        <dd>{{ $event->open_at }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>開演</dt>
        <dd>{{ $event->start_at }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>終演予定</dt>
        <dd>{{ $event->end_at }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>閉場</dt>
        <dd>{{ $event->close_at }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>計上</dt>
        <dd>{{ $event->count ? "計上する" : "計上しない" }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/'">タイトル一覧</button></dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/{{ $event->event_name }}'">イベント一覧</button></dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/{{ $event->event_name }}/{{ $event->id }}/edit'">編集</button></dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/{{ $event->event_name }}/{{ $event->id }}/delete'">削除</button></dd>
    </dl>
</section>
<section>
    <h3>メンバー確認</h3>
    @foreach ($event->user_group_users() as $line_api_user)
    <dl class="dl-flex-left dl-dt-180px">
        <dt>{{ $line_api_user->nickname() }}</dt>
        <dd>{{ $event->line_api_event_attendance($line_api_user->id) ? $event->line_api_event_attendance($line_api_user->id)->value : "無回答" }}</dd>
    </dl>
        
    @endforeach
    {{-- @foreach ($event->get_line_api_users() as $line_api_user)
    @endforeach --}}
</section>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>