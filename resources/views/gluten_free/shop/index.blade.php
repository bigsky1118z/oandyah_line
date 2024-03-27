<x-gluten_free.frame.basic>
<x-slot name="title">グルテンフリーのおみせ [グルテンフリー応援屋]</x-slot>
<x-slot name="id">shop</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/gluten_free"><h1>グルテンフリー応援屋</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/gluten_free"><h2>グルテンフリーのおみせ</h2></a></x-slot>
<section id="index">
    <dl id="dl-index">
        <dt>

        </dt>
        <dd>
            @foreach ($shops as $shop)
                <dl class="dl-flex">
                    <dt class="dt-index-card-name">{{ $shop->name }}</dt>
                    <dd class="dt-index-card-kana">{{ $shop->kana }}</dd>
                    <dd class="dt-index-card-kana">{{ $shop->full_address() }}</dd>
                    <dd>
                        <dl>
                            @foreach ($shop->contacts as $contact)
                            <dd>
                                <dl class="dl-flex">
                                    <dt>{{ $contact->type }}</dt>
                                    <dd>{{ $contact->name }}</dd>
                                    <dd>{{ $contact->value }}</dd>
                                </dl>
                            </dd>
                            @endforeach
                        </dl>
                    </dd>
                    <dd>
                        <dl>
                            @foreach ($shop->links as $link)
                            <dd>
                                <dl class="dl-flex">
                                    <dt>{{ $link->type }}</dt>
                                    <dd><a href="{{ $link->url() }}">{{ $link->name }}</a></dd>
                                    <dd></dd>
                                </dl>
                            </dd>
                            @endforeach
                        </dl>
                    </dd>
                    {{-- <dd class="dt-index-card-link"><a href="/gluten_free/shop" class="button button-move">お店をチェック</a></dd> --}}
                </dl>            
            @endforeach
        </dd>
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-gluten_free.frame.basic>