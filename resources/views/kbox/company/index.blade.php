<x-kbox.frame.basic>
<x-slot name="title">company [K Box Syestem]</x-slot>
<x-slot name="id">company</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/company"><h2>company</h2></a></x-slot>
<section id="form">
    <dl class="dl-flex">
        <dd><button>create new company</button></dd>
        <dd>
            @csrf
            <dl class="dl-flex">
                <dt style="width: 200px;">KboxCompany</dt>
                <dd>
                    <input type="file" id="input-file-csv-kbox_companies" name="csv" accept="text/csv" class="hidden" data-database="kbox_companies" onchange="file_store(this);">
                    <button type="button" onclick="document.getElementById('input-file-csv-kbox_companies').click();">input CSV file</button>
                </dd>
                <dd><button onclick="location.href = '/kbox/company/csv/kbox_companies'">output CSV file</button></dd>
            </dl>
            <dl class="dl-flex">
                <dt style="width: 200px;">KboxCompanyAddress</dt>
                <dd>
                    <input type="file" id="input-file-csv-kbox_company_addresses" name="csv" accept="text/csv" class="hidden" data-database="kbox_company_addresses" onchange="file_store(this);">
                    <button type="button" onclick="document.getElementById('input-file-csv-kbox_company_addresses').click();">input CSV file</button>
                </dd>
                <dd><button onclick="location.href = '/kbox/company/csv/kbox_company_addresses'">output CSV file</button></dd>
            </dl>
            <dl class="dl-flex">
                <dt style="width: 200px;">KboxCompanyContact</dt>
                <dd>
                    <input type="file" id="input-file-csv-kbox_company_contacts" name="csv" accept="text/csv" class="hidden" data-database="kbox_company_contacts" onchange="file_store(this);">
                    <button type="button" onclick="document.getElementById('input-file-csv-kbox_company_contacts').click();">input CSV file</button>
                </dd>
                <dd><button onclick="location.href = '/kbox/company/csv/kbox_company_contacts'">output CSV file</button></dd>
            </dl>
        </dd>
    </dl>
</section>
<section id="index">
    <dl id="dl-companies">
        <dt>
            <dl class="dl-flex dl-company-header">
                <dd>
                    <dl>
                        <dd class="dd-company-code">code</dd>
                    </dl>
                </dd>
                <dd>
                    <dl class="dl-flex flex-column dl-company-header-1">
                        <dt class="dt-company-name">official_name</dt>
                        <dd class="dd-company-kana">kana</dd>
                    </dl>
                </dd>
                <dd>
                    <dl class="dl-flex flex-column dl-company-header-2">
                        <dd class="dd-company-address">address</dd>
                        <dd class="dd-company-contact">contact</dd>
                    </dl>
                </dd>
                <dd>
                    <dl class="dl-flex dl-company-header-3">
                        <dd class="dd-company-button">button</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        @foreach (array("all", "client", "supplier", "manufacturer") as $category)
            @isset($companies[$category])
                @foreach ($companies[$category] as $company)
                    <dd data-code="{{ $company->code }}" data-kana="{{ $company->kana }}">
                        <dl class="dl-flex dl-company-content">
                            <dd>
                                <dl>
                                    <dd class="dd-company-code">{{ $company->code }}</dd>
                                </dl>
                            </dd>
                            <dd>
                                <dl class="dl-flex flex-column dl-company-content-1">
                                    <dt class="dt-company-name">{{ $company->official_name() }}</dt>
                                    <dd class="dd-company-kana">{{ $company->kana }}</dd>
                                </dl>
                            </dd>
                            <dd>
                                <dl class="dl-flex flex-column dl-company-content-2">
                                    <dd class="dd-company-address">{{ $company->address("本社")->first() ? $company->address("本社")->first()->short_address() : "-" }}</dd>
                                    <dd class="dd-company-contact">
                                        <dl class="dl-flex">
                                            <dt>TEL</dt>
                                            <dd>{{ $company->contact("tel")->first() ? $company->contact("tel")->first()->value : "-" }}</dd>
                                        </dl>
                                        <dl class="dl-flex">
                                            <dt>FAX</dt>
                                            <dd>{{ $company->contact("fax")->first() ? $company->contact("fax")->first()->value : "-" }}</dd>
                                        </dl>
                                    </dd>
                                </dl>
                            </dd>
                            <dd>
                                <dl class="dl-flex dl-flex dl-company-content-3">
                                    <dd class="dd-company-button">
                                        <button onclick="location.href = '/kbox/company/{{ $company->id }}'">詳細</button>
                                    </dd>
                                    <dd class="dd-company-button">
                                        @if (array_intersect(array("all","provider"), auth()->user()->roles("kbox")))
                                            <button onclick="confirm('{{ $company->name }}に関連するデータはすべて消えます。削除していいですか？') ? location.href = '/kbox/company/{{ $company->id }}/delete' : null">削除</button>
                                        @endif
                                    </dd>
                                </dl>
                            </dd>
                        </dl>
                    </dd>
                @endforeach
            @endisset
        @endforeach
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
                const database  =   input.getAttribute("data-database");
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
                    fetch(`/kbox/company/csv/${database}`, options).then(response => response.ok ? location.reload() : console.log(response.status));
                }
            }
        }
    </script>
</x-slot>
</x-kbox.frame.basic>