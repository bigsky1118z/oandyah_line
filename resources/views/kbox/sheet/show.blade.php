<x-kbox.frame.basic>
<x-slot name="title">sheet [K Box Syestem]</x-slot>
<x-slot name="id">sheet</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/sheet"><h2>sheet</h2></a></x-slot>
{{-- <section id="form">
    <dl class="dl-flex">
        <dd>create new sheet</dd>
        <dd><button>input CSV file</button></dd>
        <dd><button>output CSV file</button></dd>
    </dl>
</section> --}}
<section id="detail">
    <dl>
        <dt>
            <dl class="dl-flex dl-size-header">
                <dd>name</dd>
                <dd>color</dd>
                <dd>supplier</dd>
                <dd>manufacturer</dd>
            </dl>
        </dt>
        <dd>
            <dl class="dl-flex dl-size-content">
                <dd>{{ $sheet->name }}</dd>
                <dd>{{ $sheet->color }}</dd>
                <dd>{{ $sheet->supplier->name }}</dd>
                <dd>{{ $sheet->manufacturer->name }}</dd>
            </dl>
        </dd>
    </dl>
</section>
<section id="size">
    <dl id="dl-sizes">
        <dt>
            <dl class="dl-flex dl-size-header">
                <dd class="dd-size-gauge">gauge</dd>
                <dd class="dd-size-length">length</dd>
                <dd class="dd-size-width">width</dd>
                <dd class="dd-size-grammage">grammage</dd>
                <dd class="dd-size-button">button</dd>

            </dl>
        </dt>
        @if ($sheet->grams->isNotEmpty())
            @foreach ($sheet->grams as $sheet_gram)
                @if ($sheet_gram->sizes->isNotEmpty())
                    @foreach ($sheet_gram->sizes as $sheet_gram_size)
                        <dd>
                            <dl class="dl-flex dl-size-content">
                                <dd class="dd-size-gauge">{{ $sheet_gram->gauge() }}</dd>
                                <dd class="dd-size-length">{{ number_format($sheet_gram_size->length, 0, "", "") }}</dd>
                                <dd class="dd-size-width">{{ number_format($sheet_gram_size->width, 0, "", "") }}</dd>
                                <dd class="dd-size-grammage">{{ $sheet_gram_size->grammage() }}</dd>
                                <dd class="dd-size-button"></dd>
                            </dl>
                        </dd>
                    @endforeach
                @endif
            @endforeach
        @else
            <dd></dd>
        @endif
        <dd>
            <form action="">
                <dl class="dl-flex">
                    <dd class="dd-size-gauge"><input type="text" name="gauge"></dd>
                    <dd class="dd-size-length"><input type="text" name="length"></dd>
                    <dd class="dd-size-width"><input type="text" name="width"></dd>
                    <dd class="dd-size-grammage"><input type="text" name="grammage"></dd>
                    <dd class="dd-size-button"><button type="sumbit">追加</button></dd>
                </dl>
            </form>
        </dd>
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-kbox.frame.basic>