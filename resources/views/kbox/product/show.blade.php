<x-kbox.frame.basic>
<x-slot name="title">product [K Box Syestem]</x-slot>
<x-slot name="id">product</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/product"><h2>product</h2></a></x-slot>
{{-- <section id="form">
    <dl class="dl-flex">
        <dd>create new product</dd>
        <dd><button>input CSV file</button></dd>
        <dd><button>output CSV file</button></dd>
    </dl>
</section> --}}
<section id="show">
    <h4>{{ $product->display_name() }}</h4>
    <dl id="dl-product-show">
        <dt></dt>
        <dd>
            <dl class="dl-flex">
                <dt>id</dt>
                <dd>{{ isset($product->id) ? $product->id : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>code</dt>
                <dd>{{ isset($product->code) ? $product->code : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>type</dt>
                <dd>{{ isset($product->type) ? $product->type : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>company</dt>
                <dd>{{  isset($product->company) && isset($product->company->name) ? $product->company->name : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>name</dt>
                <dd>{{ isset($product->name) ? $product->name : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>classification</dt>
                <dd>{{ isset($product->classification) ? $product->classification : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>extra</dt>
                <dd>{{ isset($product->extra) ? $product->extra : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>description</dt>
                <dd>{{ isset($product->description) ? $product->description : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>color</dt>
                <dd>{{ isset($product->color) ? $product->color : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>sheet</dt>
                <dd>{{ isset($product->sheet_gram) && isset($product->sheet_gram->sheet->name) ? $product->sheet_gram->sheet->name : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>gram</dt>
                <dd>{{ isset($product->sheet_gram) && isset($product->sheet_gram->gram) ? number_format($product->sheet_gram->gram, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>length</dt>
                <dd>{{ isset($product->length) ? number_format($product->length, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>width</dt>
                <dd>{{ isset($product->width) ? number_format($product->width, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>height</dt>
                <dd>{{ isset($product->height) ? number_format($product->height, 0, ".", "") : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>low_top</dt>
                <dd>{{ isset($product->low_top) ? $product->low_top : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>assemble</dt>
                <dd>{{ isset($product->assemble) ? $product->assemble : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>cutting</dt>
                <dd>{{ isset($product->cutting) ? $product->cutting : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>processing</dt>
                <dd>{{ isset($product->processing) ? $product->processing : "-" }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>top</dt>
                <dd>
                    @if (isset($product->semi_product) && isset($product->semi_product->top))
                        <dl>
                            <dd>{{ $product->semi_product->top->code }}</dd>
                            <dd>{{ $product->semi_product->top->display_name() }}</dd>                            
                        </dl>
                    @else
                    <dd>-</dd>
                    @endif
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>bottom</dt>
                <dd>
                    <dl>
                        <dd>{{ isset($product->semi_product) && isset($product->semi_product->bottom) ? $product->semi_product->bottom->code : "-" }}</dd>
                        <dd>{{ isset($product->semi_product) && isset($product->semi_product->bottom) ? $product->semi_product->bottom->display_name() : "-" }}</dd>
                    </dl>
                </dd>
            </dl>
        </dd>
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-kbox.frame.basic>