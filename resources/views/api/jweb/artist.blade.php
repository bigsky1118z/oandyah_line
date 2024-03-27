{{-- <x-jinguji_ozora.frame.basic> --}}
{{-- <x-slot name="title">究極の未来へ導く占い師 神宮寺大空</x-slot> --}}
{{-- <x-slot name="id"></x-slot> --}}
<section id="artist">
    <dl>
        <dt></dt>
        <dd>
            @foreach ($artists as $artist)
                <dl style="display: flex">
                    <dd class="dd-artist-artist_code">{{ $artist->artist_code }}</dd>
                    <dd class="dd-artist-artist_link">{{ $artist->artist_link }}</dd>
                    <dd class="dd-artist-artist_name">{{ $artist->artist_name }}</dd>
                    <dd class="dd-artist-artist_image_thumb_url">{{ $artist->artist_image_thumb_url }}</dd>
                    <dd class="dd-artist-artist_furigana">{{ $artist->artist_furigana }}</dd>
                    <dd class="dd-artist-member_code">{{ $artist->member_code }}</dd>
                    <dd class="dd-artist-member_name">{{ $artist->member_name }}</dd>
                    <dd class="dd-artist-member_furigana">{{ $artist->member_furigana }}</dd>
                    <dd class="dd-artist-member_image_thumb_url">{{ $artist->member_image_thumb_url }}</dd>
                    <dd class="dd-artist-member_date">{{ $artist->member_date }}</dd>
                </dl>
            @endforeach
        </dd>
    </dl>
</section>
{{-- </x-jinguji_ozora.frame.basic> --}}