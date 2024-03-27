<x-line.frame.basic>
<x-slot name="id">webhook</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > <a href="/line/{{ $line->name }}/webhook">webhook</a> > follow</h2>
<section id="follow">
    <h3>一覧</h3>
    <dl id="dl-line-webhook-follow">
        <dt class="dt-line-webhook-follow-header">
            <dl>
                <dd class="dd-line-webhook-follow-group" style="display:flex;">
                    <dl class="dl-line-webhook-follow-group-0">
                        <dd class="dd-line-webhook-follow-piture">受信日時</dd>
                    </dl>
                    <dl class="dl-line-webhook-follow-group-1">
                        <dd class="dd-line-webhook-follow-display_name">LINE名</dd>
                        <dd class="dd-line-webhook-follow-naming">識別名</dd>
                    </dl>
                    <dl class="dl-line-webhook-follow-group-2">
                        <dd class="dd-line-webhook-follow-count">タイプ</dd>
                    </dl>
                    <dl class="dl-line-webhook-follow-group-button">
                        <dd class="dd-line-webhook-follow-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($line->webhooks("follow")->reverse() as $webhook)
                    <dd class="dd-line-webhook-follow-group" style="display:flex;">
                        <dl class="dl-line-webhook-follow-group-0">
                            <dd>{{ $webhook->created_at }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-follow-group-1">
                            <dd>{{ $webhook->friend ? $webhook->friend->display_name : null }}</dd>
                            <dd>{{ $webhook->friend ? $webhook->friend->naming : null }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-follow-group-2">
                            <dd>{{ $webhook->type }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-follow-group-button">
                            <dd>
                                <button type="button" onclick="location.href = '/line/{{ $line->name }}'">確認</button>
                            </dd>
                        </dl>
                    </dd>
                @endforeach
            </dl>
        </dd>
    </dl>
</section>
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-line.frame.basic>