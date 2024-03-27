<x-website.frame.basic>
<x-slot name="id">top</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="description"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="h1"></x-slot> --}}
{{-- <x-slot name="h2"></x-slot> --}}
<x-slot name="header"></x-slot>
@isset($mains)
    @foreach ($mains as $main)
        <x-website.main :page="$main->page" :option="$main->option" />
    @endforeach
@endisset
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-website.frame.basic>