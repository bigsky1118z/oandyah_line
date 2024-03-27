@php
    use App\Models\Line\LineWebhookPostback;
    $statuses   =   LineWebhookPostback::$statuses;
@endphp

<x-line.frame.basic>
<x-slot name="id">webhook</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > <a href="/line/{{ $line->name }}/webhook">webhook</a> > postback</h2>
<section id="postback">
    <h3>一覧</h3>
    <dl id="dl-line-webhook-postback">
        <dt class="dt-line-webhook-postback-header">
            <dl>
                <dd class="dd-line-webhook-postback-group" style="display:flex;">
                    <dl class="dl-line-webhook-postback-group-0">
                        <dd class="dd-line-webhook-postback-piture">受信日時</dd>
                    </dl>
                    <dl class="dl-line-webhook-postback-group-1">
                        <dd class="dd-line-webhook-postback-display_name">LINE名</dd>
                        <dd class="dd-line-webhook-postback-naming">識別名</dd>
                    </dl>
                    <dl class="dl-line-webhook-postback-group-2">
                        <dd class="dd-line-webhook-postback-count">タイプ</dd>
                    </dl>
                    <dl class="dl-line-webhook-postback-group-button">
                        <dd class="dd-line-webhook-postback-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($line->webhooks("postback")->reverse() as $webhook)
                    @if ($webhook->postback)
                        <dd class="dd-line-webhook-postback-group" style="display:flex;">
                            <dl class="dl-line-webhook-postback-group-0">
                                <dd>{{ $webhook->created_at }}</dd>
                            </dl>
                            <dl class="dl-line-webhook-postback-group-1">
                                <dd>{{ $webhook->friend ? $webhook->friend->display_name : null }}</dd>
                                <dd>{{ $webhook->friend ? $webhook->friend->naming : null }}</dd>
                            </dl>
                            <dl class="dl-line-webhook-postback-group-2">
                                <dd>{{ isset($statuses[$webhook->postback->status]) ? $statuses[$webhook->postback->status] : $webhook->postback->status }}</dd>
                                @foreach ($webhook->postback->get_data() as $key => $value)
                                <dd>{{ $key }} = {{ $value }}</dd>                                    
                                @endforeach
                            </dl>
                            <dl class="dl-line-webhook-postback-group-button">
                                <dd>
                                    <button type="button" onclick="location.href = '/line/{{ $line->name }}'">確認</button>
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