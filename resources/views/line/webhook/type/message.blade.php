@php
    use App\Models\Line\LineWebhookMessage;
    $statuses   =   LineWebhookMessage::$statuses;
@endphp

<x-line.frame.basic>
<x-slot name="id">webhook</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > <a href="/line/{{ $line->name }}/webhook">webhook</a> > message</h2>
<section id="message">
    <h3>一覧</h3>
    <dl id="dl-line-webhook-message">
        <dt class="dt-line-webhook-message-header">
            <dl>
                <dd class="dd-line-webhook-message-group" style="display:flex;">
                    <dl class="dl-line-webhook-message-group-0">
                        <dd class="dd-line-webhook-message-piture">受信日時</dd>
                    </dl>
                    <dl class="dl-line-webhook-message-group-1">
                        <dd class="dd-line-webhook-message-display_name">LINE名</dd>
                        <dd class="dd-line-webhook-message-naming">識別名</dd>
                    </dl>
                    <dl class="dl-line-webhook-message-group-2">
                        <dd class="dd-line-webhook-message-count">タイプ</dd>
                    </dl>
                    <dl class="dl-line-webhook-message-group-button">
                        <dd class="dd-line-webhook-message-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($line->webhooks("message")->reverse() as $webhook)
                @if ($webhook->message)
                    <dd class="dd-line-webhook-message-group" style="display:flex;">
                        <dl class="dl-line-webhook-message-group-0">
                            <dd>{{ $webhook->created_at }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-message-group-1">
                            <dd>{{ $webhook->friend ? $webhook->friend->display_name : null }}</dd>
                            <dd>{{ $webhook->friend ? $webhook->friend->naming : null }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-message-group-2">
                            <dd>{{ $webhook->message->type }}</dd>
                            <dd>{{ isset($statuses[$webhook->message->status]) ? $statuses[$webhook->message->status] : $webhook->postback->status }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-message-group-button">
                            <dd>
                                <button type="button" onclick="location.href = '/line/{{ $line->name }}'">返信</button>
                                <button type="button" onclick="location.href = '/line/{{ $line->name }}'">返信不要</button>
                            </dd>
                        </dl>
                    </dd>
                @endif
                @endforeach
            </dl>
        </dd>
    </dl>
</section>
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-line.frame.basic>