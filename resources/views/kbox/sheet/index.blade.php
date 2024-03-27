<x-kbox.frame.basic>
<x-slot name="title">sheet [K Box Syestem]</x-slot>
<x-slot name="id">sheet</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/sheet"><h2>sheet</h2></a></x-slot>
<section id="form">
    <dl class="dl-flex">
        <dd>create new sheet</dd>
        <dd><button>input CSV file</button></dd>
        <dd><button>output CSV file</button></dd>
    </dl>
</section>
<section id="index">
    <dl id="dl-sheets">
        <dt>
            <dl class="dl-flex dl-sheet-header">
                <dd class="dd-sheet-name">name</dd>
                <dd class="dd-sheet-color">color</dd>
                <dd class="dd-sheet-price">price</dd>
                <dd class="dd-sheet-supplier">supplier</dd>
                <dd class="dd-sheet-manufacturer">manufacturer</dd>
                <dd class="dd-sheet-button">button</dd>
            </dl>
        </dt>
        @if ($sheets->isNotEmpty())
            @foreach ($sheets as $sheet)
                <dd>
                    <dl class="dl-flex dl-sheet-content">
                        <dd class="dd-sheet-name">{{ $sheet->name }}</dd>
                        <dd class="dd-sheet-color">{{ $sheet->color }}</dd>
                        <dd class="dd-sheet-price">
                            <dl class="dl-flex flex-center">
                                <dd>{{ isset($sheet->price) ? number_format($sheet->price->purchase, 0, "", "") : null }}</dd>
                                <dd>{{ isset($sheet->price) ? number_format($sheet->price->subcontractor, 0, "", "") : null }}</dd>
                                <dd>{{ isset($sheet->price) ? number_format($sheet->price->estimate, 0, "", "") : null }}</dd>
                            </dl>
                        </dd>        
                        <dd class="dd-sheet-supplier">{{ isset($sheet->supplier) ? $sheet->supplier->name : null }}</dd>
                        <dd class="dd-sheet-manufacturer">{{ isset($sheet->manufacturer) ? $sheet->manufacturer->name : null }}</dd>
                        <dd class="dd-sheet-button"><a href="/kbox/sheet/{{ $sheet->id }}">詳細</a></dd>
                    </dl>
                </dd>
            @endforeach
        @else
            <dd>現在登録されている板紙はありません</dd>
        @endif
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-kbox.frame.basic>