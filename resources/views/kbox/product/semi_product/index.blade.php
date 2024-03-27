<x-kbox.frame.basic>
<x-slot name="title">semi product [K Box Syestem]</x-slot>
<x-slot name="id">semi_product</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/product/semi_product"><h2>semi product</h2></a></x-slot>
<ul>
    <li><a href="/kbox/product">product</a></li>
</ul>
<section id="form">
    <dl class="dl-flex">
        <dd>create new semi product</dd>
        <dd>
            @csrf
            <input type="file" id="input-file-csv" name="csv" data-database="kbox_semi_products" accept="text/csv" class="hidden" onchange="file_store(this);">
            <button onclick="document.getElementById('input-file-csv').click();">input CSV file</button>
        </dd>
        <dd><button onclick="location.href = '/kbox/product/semi_product/csv'">output CSV file</button></dd>
    </dl>
</section>
<section id="narrowdown">
    <form onchange="semi_product_narowdown(this);" onreset="semi_product_narowdown(this);">
        <dl id="dl-narrowdown">
            <dt>
                <dl class="dl-flex dl-narrowdown-header">
                    <dd class="dd-narrowdown-count">count</dd>                
                    <dd class="dd-narrowdown-type">type</dd>
                    <dd class="dd-narrowdown-company">company</dd>
                    <dd class="dd-narrowdown-color">color</dd>
                    <dd class="dd-narrowdown-length">length</dd>
                    <dd class="dd-narrowdown-width">width</dd>
                    <dd class="dd-narrowdown-height">height</dd>
                </dl>
            </dt>
            <dd>
                <dl class="dl-flex dl-narrowdown-content">
                    <dd class="dd-narrowdown-count"><span id="semi_products-counter">{{ $semi_products->count() }}</span>件</dd>
                    <dd class="dd-narrowdown-part">
                        <select name="part">
                            <option value="">all</option>
                            @foreach ($semi_products->unique("part") as $semi_product)
                                <option value="{{ $semi_product->part }}">{{ $semi_product->part }}</option>
                            @endforeach
                        </select>
                    </dd>
                    <dd class="dd-narrowdown-company">
                        <input type="text" name="company" list="input_form_company">
                        <datalist id="input_form_company">
                            @foreach ($semi_products->unique("kbox_company_id") as $semi_product)
                            @isset($semi_product->company->name)
                                <option value="{{ $semi_product->company->name }}">{{ $semi_product->company->name }}</option>
                            @endisset
                            @endforeach
                        </datalist>
                    </dd>
                    <dd class="dd-narrowdown-color">
                        <input type="text" name="color" list="input_form_color">
                        <datalist id="input_form_color">
                            @foreach ($semi_products->unique("color") as $semi_product)
                            @if($semi_product->color)
                                <option value="{{ $semi_product->color }}">{{ $semi_product->color }}</option>
                            @endisset
                            @endforeach
                        </datalist>
                    </dd>
                    <dd class="dd-narrowdown-length">
                        <dl class="dl-flex flex-column">
                            <dd><input type="number" name="length_over" min="0" max="9999"></dd>
                            <dd><input type="number" name="length_under" min="0" max="9999"></dd>
                        </dl>
                    </dd>
                    <dd class="dd-narrowdown-width">
                        <dl class="dl-flex flex-column">
                            <dd><input type="number" name="width_over" min="0" max="9999"></dd>
                            <dd><input type="number" name="width_under" min="0" max="9999"></dd>
                        </dl>
                    </dd>
                    <dd class="dd-narrowdown-height">
                        <dl class="dl-flex flex-column">
                            <dd><input type="number" name="height_over" min="0" max="9999"></dd>
                            <dd><input type="number" name="height_under" min="0" max="9999"></dd>
                        </dl>
                    </dd>
                    <dd><input type="reset"></dd>
                </dl>
            </dd>
        </dl>
    </form>
</section>
<section id="index">
    <dl id="dl-semi_products">
        <dt>
            <dl class="dl-flex dl-semi_product-header">
                <dd class="dd-semi_product-group-0">
                    <dl class="dl-flex">
                        <dd class="dd-semi_product-code">code</dd>
                        <dd class="dd-semi_product-part">part</dd>
                    </dl>
                </dd>
                <dd class="dd-semi_product-group-1">
                    <dl class="dl-flex">
                        <dd class="dd-semi_product-company">company</dd>
                        <dd class="dd-semi_product-name">name</dd>
                        <dd class="dd-semi_product-classification">classification</dd>
                        <dd class="dd-semi_product-extra">extra</dd>
                        <dd class="dd-semi_product-color">color</dd>
                    </dl>
                </dd>
                <dd class="dd-semi_product-group-2">
                    <dl class="dl-flex">
                        <dd class="dd-semi_product-sizes">sizes</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        @if ($semi_products->isNotEmpty())
            @foreach ($semi_products as $semi_product)
                <dd data-semi_product-part="{{ $semi_product->part }}" data-semi_product-company="{{ isset($semi_product->company) ? $semi_product->company->name : "-" }}" data-semi_product-color="{{ isset($semi_product->color) ? $semi_product->color : "-" }}" data-semi_product-length="{{ number_format($semi_product->length, 0, ".", "") }}" data-semi_product-width="{{ number_format($semi_product->width, 0, ".", "") }}" data-semi_product-height="{{ number_format($semi_product->height, 0, ".", "") }}">
                    <dl class="dl-flex dl-semi_product-content">
                        <dd class="dd-semi_product-group-0">
                            <dl class="dl-flex">
                                <dd class="dd-semi_product-code">{{ $semi_product->code }}</dd>
                                <dd class="dd-semi_product-part">{{ $semi_product->part }}</dd>
                            </dl>
                        </dd>
                        <dd class="dd-semi_product-group-1">
                            <dl class="dl-flex">
                                <dd class="dd-semi_product-company">{{ isset($semi_product->company) ? $semi_product->company->name : "-" }}</dd>
                                <dd class="dd-semi_product-name">{{ isset($semi_product->name) ? $semi_product->name : "-" }}</dd>
                                <dd class="dd-semi_product-classification">{{ isset($semi_product->classification) ? $semi_product->classification : "-" }}</dd>
                                <dd class="dd-semi_product-extra">{{ isset($semi_product->extra) ? $semi_product->extra : "-" }}</dd>
                                <dd class="dd-semi_product-color">{{ isset($semi_product->color) || $semi_product->color != "無地" ? $semi_product->color : "-" }}</dd>
                            </dl>
                        </dd>
                        <dd class="dd-semi_product-group-2">
                            <dl class="dl-flex">
                                <dd class="dd-semi_product-sizes">
                                    <dl class="dl-flex">
                                        <dd class="dd-semi_product-length">{{ isset($semi_product->length) ? number_format($semi_product->length, 0, ".", "") : "-" }}</dd>
                                        <dd class="dd-semi_product-width">{{ isset($semi_product->width) ? number_format($semi_product->width, 0, ".", "") : "-" }}</dd>
                                        <dd class="dd-semi_product-height">{{ isset($semi_product->height) ? number_format($semi_product->height, 0, ".", "") : "-" }}</dd>
                                    </dl>
                                </dd>
                            </dl>
                        </dd>
                        <dd class="dd-semi_product-group-3">
                            <dl class="dl-flex">
                                <dd><button type="button" onclick="location.href = '/kbox/product/semi_product/{{ $semi_product->id }}'">show</button></dd>
                                <dd>
                                    @if (array_intersect(array("all","provider"), auth()->user()->roles("kbox")))
                                        <button type="button" onclick="confirm('{{ $semi_product->display_name() }}<{{ $semi_product->display_size() }}>に関連するデータはすべて消えます。削除していいですか？') ? location.href = '/kbox/product/semi_product/{{ $semi_product->id }}/delete' : null">delete</button>
                                    @endif
                                </dd>
                            </dl>
                        </dd>
                    </dl>
                </dd>
            @endforeach
        @else
            <dd>現在登録されている半製品はありません</dd>
        @endif
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script">
    <script>
        const token =   document.querySelector("input[name='_token']").value;

        function file_store(input) {
            const files     =   input.files;
            if(files){
                const formData  =   new FormData();
                for(const file of files){
                    formData.append("_token", token);
                    formData.append("csv", file);
                    const options    =   {
                        "method"    :   "post",
                        "headers"   :   {
                            "enctype"   :   "multipart/form-data",
                        },
                        "body"      :   formData,
                    }
                    fetch("/kbox/product/semi_product/csv", options).then(response => response.ok ? location.reload() : console.log(response.status));
                    // fetch("/kbox/product/semi_product/csv", options).then(response => {
                    //     if(response.ok){
                    //         return response.json();
                    //     } else {
                    //         throw Error();
                    //     }
                    // }).then(data =>{
                    //     console.log(data);  
                    // });
                }
            }
        }

        function semi_product_narowdown(form) {
            const columns   =   {
                "part"          :   form.querySelector("select[name='part']").value,
                "company"       :   form.querySelector("input[name='company']").value,
                "color"         :   form.querySelector("input[name='color']").value,
                "length_over"   :   form.querySelector("input[name='length_over']").value,
                "length_under"  :   form.querySelector("input[name='length_under']").value,
                "width_over"    :   form.querySelector("input[name='width_over']").value,
                "width_under"   :   form.querySelector("input[name='width_under']").value,
                "height_over"   :   form.querySelector("input[name='height_over']").value,
                "height_under"  :   form.querySelector("input[name='height_under']").value,
            };
            const dl    =   document.getElementById("dl-semi_products");
            let count   =   0;
            Array.from(dl.children).forEach((dd, index) => {
                if(index == 0){
                    return false;
                }
                if(index >= 1){
                    dd.classList.remove("hidden");
                    Object.keys(columns).forEach(key => {
                        const column    =   columns[key];
                        if(column) {
                            switch(key) {
                                case "part" :
                                    dd.getAttribute("data-semi_product-" + key) == column ? null : dd.classList.add("hidden");
                                    break;
                                case "company":
                                case "color":
                                    dd.getAttribute("data-semi_product-" + key).includes(column) ? null : dd.classList.add("hidden");
                                    break;
                                case "length_over" :
                                case "width_over" :
                                case "height_over" :
                                    console.log(key, dd.getAttribute("data-semi_product-" + key), column);
                                    Number(dd.getAttribute("data-semi_product-" + key.replace("_over",""))) >= Number(column) ? null : dd.classList.add("hidden");
                                    break;
                                case "length_under" :
                                case "width_under" :
                                case "height_under" :
                                    Number(dd.getAttribute("data-semi_product-" + key.replace("_under",""))) <= Number(column) ? null : dd.classList.add("hidden");
                                    break;

                                default :
                                    if(dd.getAttribute("data-semi_product-"+key) == column){
                                    } else {
                                        dd.classList.add("hidden");
                                    }
                            }
                        } else {

                        }
                    });
                    dd.classList.contains("hidden") ? null : count++;
                }
            });
            document.getElementById("semi_products-counter").textContent = count;
        }
    </script>
</x-slot>
</x-kbox.frame.basic>