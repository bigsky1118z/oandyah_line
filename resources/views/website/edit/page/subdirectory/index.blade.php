<x-website.frame.edit>
<x-slot name="title">subdirectory</x-slot>
<x-slot name="id">subdirectory</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > 個別ページ</x-slot>
<section id="index">
    <h3>subdirectory list</h3>
    <dl id="dl-subdirectory-index">
        <dt>
            <dl class="dl-subdirectory-index-header">
                <dd class="dd-subdirectory-index-path">path</dd>
                <dd class="dd-subdirectory-index-title">title</dd>
                <dd class="dd-subdirectory-index-button">button</dd>
            </dl>
        </dt>
        @foreach ($subdirectories as $path => $title)
        <dd>
            <dl class="dl-subdirectory-index-body">
                <dd class="dd-subdirectory-index-path">{{ $path }}</dd>
                <dd class="dd-subdirectory-index-title">{{ $title }}</dd>
                <dd class="dd-subdirectory-index-button">
                    <button type="button" onclick="location.href = '/{{ $path }}'">移動</button>
                    <button type="button" onclick="location.href = '/{{ $path }}/edit'">編集</button>
                </dd>
            </dl>
        </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
    
</x-website.frame.edit>