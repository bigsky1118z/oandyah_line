<x-admin.api.line.frame.basic title="イベント" heading="イベント" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <dl>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/event/create'">イベント作成</button></dd>
    </dl>
    <h3>イベント一覧</h3>
    <ul>
        @foreach ($grouped_events as $event_name => $events)
            <li><a href="/api/line/{{ $channel->channel_name }}/event/{{ $event_name }}">{{ $event_name }}</a></li>
        @endforeach
    </ul>
</section>
<x-slot name="script">
<script>
</script>
</x-slot>
</x-admin.api.frame.basic>