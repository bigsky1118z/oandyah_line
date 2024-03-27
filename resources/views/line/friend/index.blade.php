<x-line.frame.basic>
<x-slot name="id">friend</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > 友だち</h2>
<section id="index">
    <h3>一覧</h3>
    {{-- <img id="img-line-icon" src="{{ $line->image_url_icon() }}"> --}}
    <p class="p-line-edit"><button type="button" onclick="location.href='/line/{{ $line->name }}/friend/update'">更新</button></p>
    <dl id="dl-line-friend-index">
        <dt class="dt-line-friend-index-header">
            <dl>
                <dd class="dd-line-friend-index-group" style="display:flex;">
                    <dl class="dl-line-friend-index-group-0">
                        <dd class="dd-line-friend-index-piture">アイコン</dd>
                    </dl>
                    <dl class="dl-line-friend-index-group-1">
                        <dd class="dd-line-friend-index-nickname">登録名</dd>
                        <dd class="dd-line-friend-index-display_name">LINE名</dd>
                        <dd class="dd-line-friend-index-naming">識別名</dd>
                    </dl>
                    <dl class="dl-line-friend-index-group-2">
                        <dd class="dd-line-friend-index-count">グループ</dd>
                    </dl>
                    <dl class="dl-line-friend-index-group-button">
                        <dd class="dd-line-friend-index-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($line->friends as $friend)
                    <dd class="dd-line-friend-index-group dd-line-friend-status-{{ $friend->status }}" style="display:flex;">
                        <dl class="dl-line-friend-index-group-0">
                            <dd><img src="{{ $friend->picture_url }}" alt="" width="75" height="75"></dd>
                        </dl>
                        <dl class="dl-line-friend-index-group-1">
                            <dd>{{ $friend->name ? $friend->name->nickname : "未設定" }}</dd>
                            <dd>{{ $friend->display_name ? $friend->display_name : "更新してください" }}</dd>
                            <dd><input type="text" value="{{ $friend->naming }}"></dd>
                            <dd><input type="text" value="{{ $friend->line_user_id }}"></dd>
                        </dl>
                        <dl class="dl-line-friend-index-group-2">
                            @foreach ($friend->groups as $group)
                                @if ($group->group)
                                    <dd><a href="/line/{{ $line->name }}/group/{{ $group->group->name }}">{{ $group->group->title }}</a></dd>                                
                                @endif
                            @endforeach
                        </dl>
                        <dl class="dl-line-friend-index-group-button">
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