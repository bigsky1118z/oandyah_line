<x-website.frame.basic>
<x-slot name="id">multiple</x-slot>
<x-slot name="description">{{ strip_tags($article->body) }}</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
@if($article->image_header_url)
    <x-slot name="imageheaderurl">{{ $article->image_header_url }}</x-slot>
@elseif($page->image_header_url)
    <x-slot name="imageheaderurl">{{ $page->image_header_url }}</x-slot>
@endif
<x-slot name="h2"><a href="/{{ $page->path }}">{{  $page->title }}</a></x-slot>
<section id="">
    <h3>{{  $article->title }}</h3>
    <p>{{  $article->valid_at }}</p>
    {!!  $article->body !!}
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-website.frame.basic>