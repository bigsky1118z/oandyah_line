<x-admin.api.line.frame.basic title="イベント" heading="イベント" :channel="$channel">
<x-slot name="head">
</x-slot>
<ul>
    @foreach ($grouped_events as $name => $event)
    <li>{{ $event }}</li>
        
    @endforeach
</ul>
<button type="submit">登録</button>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>