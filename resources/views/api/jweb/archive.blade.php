{{-- <x-jinguji_ozora.frame.basic> --}}
{{-- <x-slot name="title">究極の未来へ導く占い師 神宮寺大空</x-slot> --}}
{{-- <x-slot name="id"></x-slot> --}}
<section id="archive">
    <dl>
        <dt></dt>
        <dd>
            @foreach ($archives as $archive)
                <dl style="display: flex">
                    <dd>{{ $archive->id }}</dd>
                    <dd>{{ $archive->type }}</dd>
                    <dd>{{ $archive->code }}</dd>
                    <dd>{{ $archive->code1 }}</dd>
                    <dd>{{ $archive->name }}</dd>
                    <dd>{{ $archive->artist_code }}</dd>
                    <dd>{{ $archive->artist_name }}</dd>
                    <dd>{{ $archive->category_code }}</dd>
                    <dd>{{ $archive->date }}</dd>
                    <dd><img src="{{ Str::contains($archive->image_url, 'https://www.johnnys-web.com/') ? $archive->image_url : 'https://www.johnnys-web.com/' . $archive->image_url }}" alt="" width="100px" height="auto"></dd>
                    <dd>{{ $archive->inbox_flag1 }}</dd>
                    <dd>{{ $archive->inbox_type }}</dd>
                    <dd><img src="https://www.johnnys-web.com/{{ $archive->inbox_thumb }}" alt="" width="100px" height="auto"></dd>
                    <dd>{{ $archive->caption }}</dd>
                    <dd><a href="https://www.johnnys-web.com{{ $archive->link }}">記事</a></dd>
                </dl>
            @endforeach
        </dd>
    </dl>
</section>
{{-- </x-jinguji_ozora.frame.basic> --}}