<x-line.frame.basic>
<x-slot name="id">webhook</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > webhook</h2>
<section id="menu">
    <dl>
        <dd><a href="/line/{{ $line->name }}/webhook/message">message</a></dd>
        <dd><a href="/line/{{ $line->name }}/webhook/postback">postback</a></dd>
        <dd><a href="/line/{{ $line->name }}/webhook/follow">follow</a></dd>
    </dl>
</section>
<section id="index">
    <h3>一覧</h3>
    <dl id="dl-line-webhook-index">
        <dt class="dt-line-webhook-index-header">
            <dl>
                <dd class="dd-line-webhook-index-group" style="display:flex;">
                    <dl class="dl-line-webhook-index-group-0">
                        <dd class="dd-line-webhook-index-piture">受信日時</dd>
                    </dl>
                    <dl class="dl-line-webhook-index-group-1">
                        <dd class="dd-line-webhook-index-display_name">LINE名</dd>
                        <dd class="dd-line-webhook-index-naming">識別名</dd>
                    </dl>
                    <dl class="dl-line-webhook-index-group-2">
                        <dd class="dd-line-webhook-index-count">タイプ</dd>
                    </dl>
                    <dl class="dl-line-webhook-index-group-button">
                        <dd class="dd-line-webhook-index-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($line->webhooks->reverse() as $webhook)
                    <dd class="dd-line-webhook-index-group" style="display:flex;">
                        <dl class="dl-line-webhook-index-group-0">
                            <dd>{{ $webhook->created_at }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-index-group-1">
                            <dd>{{ $webhook->friend ? $webhook->friend->display_name : null }}</dd>
                            <dd>{{ $webhook->friend ? $webhook->friend->naming : null }}</dd>
                        </dl>
                        <dl class="dl-line-webhook-index-group-2">
                            <dd>{{ $webhook->type }}</dd>
                            @if ($webhook->type == "message")
                                <dd>{{ $webhook->message->type }}</dd>
                            @endif
                        </dl>
                        <dl class="dl-line-webhook-index-group-button">
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
<section id="line-link">
    @isset($user)
        <p class="p-line-edit"><button type="button" onclick="location.href='/line/{{ $line->name }}/link'">リンク管理</button></p>
    @endisset
    <dl id="dl-line-link">
        
        {{-- @foreach ($line->links as $link)
            @if ($link->active)
                <dd class="dd-line-link-body dd-line-link-{{ $link->type }}">
                    <a href="{{ $link->url() }}" target="_blank" rel="noopener noreferrer">
                        <img class="img-line-link-body-logo" src="{{ $link->image_url_logo() }}">
                        <dl class="dl-line-link-body-values">
                            @if ($link->title)
                                <dd class="dd-line-link-body-title">{{ $link->title }}</dd>
                            @elseif(!$link->title && in_array($link->type, array("x","instagram","tiktok","youtube")))
                                <dd class="dd-line-link-body-title">{{ $sns_types[$link->type] . "（@" . $link->value . "）" }}</dd>
                            @else
                                <dd class="dd-line-link-body-title">{{ $sns_types[$link->type] }}</dd>
                            @endif
                            <dd class="dd-line-link-body-description">{{ $link->description }}</dd>
                        </dl>
                    </a>
                </dd>
            @endif
        @endforeach --}}
    </dl>
    @isset($user)
        <p class="p-line-edit"><button type="button" onclick="location.href='/line/{{ $line->name }}/link'">リンク管理</button></p>
    @endisset
</section>

<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-line.frame.basic>