<x-admin.api.line.frame.basic title="{{ $event_name }} [イベント]" heading="{{ $event_name }} [イベント]" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <h3>統計</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>回答人数</dt>
        <dd>{{ collect($events->where("count",true)->pluck("line_api_event_attendances"))->flatten()->count() }}</dd>
    </dl>
</section>
<section>
    <h3>イベント内容一覧</h3>
    <dl>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/{{ $event_name }}/create'">イベント追加</button></dd>
    </dl>
    <ul>
        @foreach ($events as $event)
        <dl class="dl-flex-left dl-dt-120px">
            <dd>{{ $event->open_at }}</dd>
            <dd>{{ $event->schedule_name }}</dd>
            <dd>{{ $event->status }}</dd>
            <dd>{{ $event->organizer }}</dd>
            <dd>{{ $event->place }}</dd>
            <dd>{{ $event->price }}</dd>
            <dd>{{ $event->count ? $event->user_group_users()->count() : "-" }}</dd>
            <dd>{{ $event->count ? $event->line_api_event_attendances->where("value","出席")->count() : "-" }}</dd>
            <dd>{{ $event->count ? $event->line_api_event_attendances->where("value","保留")->count() : "-" }}</dd>
            <dd>{{ $event->count ? $event->line_api_event_attendances->where("value","欠席")->count() : "-" }}</dd>
            <dd>{{ $event->count ? (int) $event->user_group_users()->count() - (int) $event->line_api_event_attendances->count() : "-" }}</dd>
            <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/{{ $event->event_name }}/{{ $event->id }}'">詳細</button></dd>
            <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/{{ $event->event_name }}/{{ $event->id }}/edit'">編集</button></dd>
            <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/{{ $event->event_name }}/{{ $event->id }}/delete'">削除</button></dd>
        </dl>
        @endforeach
    </ul>
</section>
{{-- <section>
    <h3>出欠一覧</h3>
    @foreach ($event->get_line_api_users() as $line_api_user)
        <dl class="dl-flex-left dl-dt-120px">
            <dt>{{ $line_api_user->nickname() }}</dt>
            @foreach ($events as $event)
                <dd>{{ $line_api_user->line_api_event_attendances()->where("line_api_event_id",$event->id)->exists() ? $line_api_user->line_api_event_attendances()->where("line_api_event_id",$event->id)->first()->value : "未回答" }}</dd>
            @endforeach
        </dl>
    @endforeach
    @foreach (array("出席","欠席","未回答","合計") as $value)
        <dl class="dl-flex-left dl-dt-120px">
            <dt>{{ $value }}</dt>
            @foreach ($events as $event)
                @if ($value == "合計")
                    <dd>{{ $event->line_api_event_attendances->count() }}</dd>
                @else
                    <dd>{{ $event->line_api_event_attendances->where("value",$value)->count() }}</dd>
                @endif
            @endforeach
        </dl>
    @endforeach
</section> --}}
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>