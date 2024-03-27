<x-kbox.frame.basic>
<x-slot name="title">semi product [K Box Syestem]</x-slot>
<x-slot name="id">semi_product</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/semi_product"><h2>semi product</h2></a></x-slot>
{{-- <section id="form">
    <dl class="dl-flex">
        <dd>create new semi_product</dd>
        <dd><button>input CSV file</button></dd>
        <dd><button>output CSV file</button></dd>
    </dl>
</section> --}}
<section id="show">
    <h4>{{ $semi_product->display_name() }}</h4>
    <dl id="dl-semi_product-show">
        <dt></dt>
        <dd>
            <dl class="dl-flex">
                <dt>id</dt>
                <dd>{{ isset($semi_product->id) ? $semi_product->id : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>code</dt>
                <dd>{{ isset($semi_product->code) ? $semi_product->code : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>part</dt>
                <dd>{{ isset($semi_product->part) ? $semi_product->part : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>company</dt>
                <dd>{{  isset($semi_product->company) && isset($semi_product->company->name) ? $semi_product->company->name : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>name</dt>
                <dd>{{ isset($semi_product->name) ? $semi_product->name : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>classification</dt>
                <dd>{{ isset($semi_product->classification) ? $semi_product->classification : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>extra</dt>
                <dd>{{ isset($semi_product->extra) ? $semi_product->extra : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>description</dt>
                <dd>{{ isset($semi_product->description) ? $semi_product->description : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>color</dt>
                <dd>{{ isset($semi_product->color) ? $semi_product->color : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>sheet</dt>
                <dd>{{ isset($semi_product->sheet_gram) && isset($semi_product->sheet_gram->sheet->name) ? $semi_product->sheet_gram->sheet->name : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>gram</dt>
                <dd>{{ isset($semi_product->sheet_gram) && isset($semi_product->sheet_gram->gram) ? number_format($semi_product->sheet_gram->gram, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>length</dt>
                <dd>{{ isset($semi_product->length) ? number_format($semi_product->length, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>width</dt>
                <dd>{{ isset($semi_product->width) ? number_format($semi_product->width, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>height</dt>
                <dd>{{ isset($semi_product->height) ? number_format($semi_product->height, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>low_top</dt>
                <dd>{{ isset($semi_product->low_top) ? $semi_product->low_top : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>processing</dt>
                <dd>{{ isset($semi_product->processing) ? $semi_product->processing : "-" }}</dd>
            </dl>
        </dd>
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-kbox.frame.basic>