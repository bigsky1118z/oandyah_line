<x-sns.frame.basic>
<x-slot name="id">sns</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
@if ($sns->description)
    <x-slot name="description">{{ $sns->description }}</x-slot>
@endif
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<section id="sns">
    <img id="img-sns-icon" src="{{ $sns->image_url_icon() }}">
    <h2 id="h2-sns-title">{{ $sns->title }}</h2>
    <p id="p-sns-description">{{ $sns->description }}</p>
    @isset($user)
        <p class="p-sns-edit"><button type="button" onclick="location.href='/sns/{{ $sns->name }}/edit'">設定変更</button></p>
    @endisset

</section>
<section id="sns-link">
    @isset($user)
        <p class="p-sns-edit"><button type="button" onclick="location.href='/sns/{{ $sns->name }}/link'">リンク管理</button></p>
    @endisset
    <dl id="dl-sns-link">
        @foreach ($sns->links as $link)
            @if ($link->active)
                <dd class="dd-sns-link-body dd-sns-link-{{ $link->type }}">
                    <a href="{{ $link->url() }}" target="_blank" rel="noopener noreferrer">
                        <img class="img-sns-link-body-logo" src="{{ $link->image_url_logo() }}">
                        <dl class="dl-sns-link-body-values">
                            @if ($link->title)
                                <dd class="dd-sns-link-body-title">{{ $link->title }}</dd>
                            @elseif(!$link->title && in_array($link->type, array("x","instagram","tiktok","youtube")))
                                <dd class="dd-sns-link-body-title">{{ $sns_types[$link->type] . "（@" . $link->value . "）" }}</dd>
                            @else
                                <dd class="dd-sns-link-body-title">{{ $sns_types[$link->type] }}</dd>
                            @endif
                            <dd class="dd-sns-link-body-description">{{ $link->description }}</dd>
                        </dl>
                    </a>
                </dd>
            @endif
        @endforeach
    </dl>
    @isset($user)
        <p class="p-sns-edit"><button type="button" onclick="location.href='/sns/{{ $sns->name }}/link'">リンク管理</button></p>
    @endisset
</section>

<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-sns.frame.basic>