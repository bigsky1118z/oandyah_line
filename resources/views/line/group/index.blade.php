<x-line.frame.basic>
<x-slot name="id">group</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > グループ</h2>
<section id="index">
    {{-- <img id="img-line-icon" src="{{ $line->image_url_icon() }}"> --}}
    <h3>一覧</h3>
    <dl id="dl-line-group-index">
        <dt class="dt-line-group-index-header">
            <dl>
                <dd class="dd-line-group-index-group" style="display:flex;">
                    <dl class="dl-line-group-index-group-0">
                        <dd class="dd-line-group-index-name">名前</dd>
                        <dd class="dd-line-group-index-title">タイトル</dd>
                    </dl>
                    <dl class="dl-line-group-index-group-1">
                        <dd class="dd-line-group-index-description">説明</dd>
                    </dl>
                    <dl class="dl-line-group-index-group-2">
                        <dd class="dd-line-group-index-count">登録</dd>
                    </dl>
                    <dl class="dl-line-group-index-group-button">
                        <dd class="dd-line-group-index-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($line->groups as $group)
                    <dd class="dd-line-group-index-group" style="display:flex;">
                        <dl class="dl-line-group-index-group-0">
                            <dd class="dd-line-group-index-name">{{ $group->name }}</dd>
                            <dd class="dd-line-group-index-title">{{ $group->title }}</dd>
                        </dl>
                        <dl class="dl-line-group-index-group-1">
                            <dd class="dd-line-group-index-description">{{ $group->description }}</dd>
                        </dl>
                        <dl class="dl-line-group-index-group-2">
                            <dd class="dd-line-group-index-count">{{ $group->friends->count() }}</dd>
                        </dl>
                        <dl class="dl-line-group-index-group-button">
                            <dd>
                                <button type="button" onclick="location.href = '/line/{{ $line->name }}/group/{{ $group->name }}'">確認</button>
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