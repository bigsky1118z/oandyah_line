<x-website.frame.edit>
<x-slot name="title">page</x-slot>
<x-slot name="id">page</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2">ページ</x-slot>
<section id="index">
    <h3>各ページ</h3>
    <dl id="dl-page-list">
        @foreach ($types as $type => $value)
            <dd>
                <dl class="dl-page-list-value">
                    <dt class="dt-page-list-value-title">{{ $value }}</dt>
                    <dd class="dd-page-list-value-button">
                        <button onclick="location.href='/edit/page/{{ $type }}'">詳細</button>
                    </dd>
                </dl>
            </dd>
        @endforeach
    </dl>
    <h3>ページ一覧</h3>
    <dl id="dl-page-index">
        <dt>
            <dl class="dl-flex dl-page-index-header">
                <dd class="dd-page-index-type">種類</dd>
                <dd class="dd-page-index-path">パス</dd>
                <dd class="dd-page-index-title">タイトル</dd>
                <dd class="dd-page-index-status">公開設定</dd>
                <dd class="dd-page-index-button">操作</dd>
            </dl>
        </dt>
        @foreach ($types as $type => $value)
            @if(isset($pages[$type]))
                @foreach ($pages[$type] as $page)
                    <dd>
                        <dl class="dl-flex dl-page-index-body">
                            <dd class="dd-page-index-type">{{ isset($page->type, $types, $types[$page->type]) ? $types[$page->type] : "---" }}</dd>
                            <dd class="dd-page-index-path">{{ isset($page->path) ? $page->path : "---" }}</dd>
                            <dd class="dd-page-index-title">{{ isset($page->title) ? $page->title : "---" }}</dd>
                            <dd class="dd-page-index-status">{{ isset($page->status) && isset($statuses[$page->status]) ? $statuses[$page->status] : "---" }}</dd>
                            <dd class="dd-page-index-button">
                                <dl class="dl-flex">
                                    @if ($type == "subdirectory")
                                        <dd><button type="button" onclick="location.href = '/{{ $page->path }}'">移動</button></dd>
                                        <dd><button type="button" onclick="location.href = '/{{ $page->path }}/edit'">編集</button></dd>
                                    @else
                                        <dd><button type="button" onclick="location.href = '/edit/page/{{ $page->type }}/{{ $page->id }}'">移動</button></dd>
                                        <dd><button type="button" onclick="location.href = '/edit/page/{{ $page->type }}/{{ $page->id }}/edit'">編集</button></dd>
                                    @endif
                                </dl>
                            </dd>
                        </dl>
                    </dd>
                @endforeach
            @endif
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
    
</x-website.frame.edit>