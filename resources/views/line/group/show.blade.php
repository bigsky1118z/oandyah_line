<x-line.frame.basic>
<x-slot name="id">group</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > <a href="">グループ</a> > {{ $group->name }}</h2>
<section id="show">
    {{-- <img id="img-line-icon" src="{{ $line->image_url_icon() }}"> --}}
    <h3>設定</h3>
    <dl id="dl-line-group-show">
        <dd style="display:flex;">
            <dl>
                <dt>name</dt>
                <dd>{{ $group->name }}</dd>
            </dl>
            <dl>
                <dt>title</dt>
                <dd>{{ $group->title }}</dd>
            </dl>
            <dl>
                <dt>description</dt>
                <dd>{{ $group->description }}</dd>
            </dl>
        </dd>
    </dl>
</section>
<section id="group-friend">
    <h3>登録者一覧</h3>
    <dl id="dl-line-group-friend">
        <dt class="dt-line-group-friend-header">
            <dl>
                <dd class="dd-line-group-friend-group" style="display:flex;">
                    <dl class="dl-line-group-friend-group-0">
                        <dd class="dd-line-group-friend-piture">アイコン</dd>
                    </dl>
                    <dl class="dl-line-group-friend-group-1">
                        <dd class="dd-line-group-friend-nickname">登録名</dd>
                        <dd class="dd-line-group-friend-display_name">LINE名</dd>
                        <dd class="dd-line-group-friend-naming">識別名</dd>
                    </dl>
                    {{-- <dl class="dl-line-group-friend-group-2">
                        <dd class="dd-line-group-friend-count">グループ</dd>
                    </dl> --}}
                    <dl class="dl-line-group-friend-group-button">
                        <dd class="dd-line-group-friend-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($group->friends as $friend)
                    @if ($friend->friend)
                        <dd class="dd-line-group-friend-group" style="display:flex;">
                            <dl class="dl-line-group-friend-group-0">
                                <dd><img src="{{ $friend->friend->picture_url }}" alt="" width="75" height="75"></dd>
                            </dl>
                            <dl class="dl-line-group-friend-group-1">
                                <dd>{{ $friend->friend->name ? $friend->friend->name->nickname : "未設定" }}</dd>
                                <dd>{{ $friend->friend->display_name ? $friend->friend->display_name : "更新してください" }}</dd>
                                <dd><input type="text" value="{{ $friend->friend->naming }}"></dd>
                            </dl>
                            {{-- <dl class="dl-line-group-friend-group-2">
                                @foreach ($friend->friend->groups as $group)
                                    @if ($group->group)
                                        <dd><a href="/line/{{ $line->name }}/group/{{ $group->group->name }}">{{ $group->group->title }}</a></dd>                                
                                    @endif
                                @endforeach
                            </dl> --}}
                            <dl class="dl-line-group-friend-group-button">
                                <dd>
                                    <button type="button" onclick="location.href = '/line/{{ $line->name }}'">確認</button>
                                </dd>
                            </dl>
                        </dd>
                    @endif
                @endforeach
            </dl>

        </dd>
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