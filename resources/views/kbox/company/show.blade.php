<x-kbox.frame.basic>
<x-slot name="title">company [K Box Syestem]</x-slot>
<x-slot name="id">company</x-slot>
<x-slot name="head">
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/company"><h2>company</h2></a></x-slot>
<section id="form">
    <dl class="dl-flex">
        <dd><button>create new company</button></dd>
    </dl>
</section>
<section id="name">
    <h3>name</h3>
    <dl id="dl-names">
        <dt>
            <dl class="dl-flex dl-name-header">
                <dd class="dd-name-code">code</dd>
                <dd class="dd-name-name">name</dd>
                <dd class="dd-name-kana">kana</dd>
                <dd class="dd-name-company_type">type</dd>
            </dl>
        </dt>
        <dd>
            <dl class="dl-flex dl-name-content">
                <dd class="dd-name-code">{{ $company->code }}</dd>
                <dd class="dd-name-name">{{ $company->name }}</dd>
                <dd class="dd-name-kana">{{ $company->kana }}</dd>
                <dd class="dd-name-company_type">{{ $company->company_type }}</dd>
            </dl>
        </dd>
    </dl>
</section>
<section id="billing">
    <h3>billing</h3>
    <dl id="dl-billings">
        <dt>
            <dl class="dl-flex dl-billing-header">
                <dd class="dd-billing-closing_date">closing_date</dd>
                <dd class="dd-billing-payment_date">payment_date</dd>
                <dd class="dd-billing-billing_to">billing_to</dd>
                <dd class="dd-billing-description">description</dd>
            </dl>
        </dt>
        @if ($company->billings->isNotEmpty())
            @foreach ($company->billings as $billing)
                <dd>
                    <dl class="dl-flex dl-billing-content">
                        <dd class="dd-billing-closing_date">{{ $billing->closing_date }}日</dd>
                        <dd class="dd-billing-payment_date">{{ $billing->payment_date == 99 ? "末" : $billing->payment_date }}日</dd>
                        <dd class="dd-billing-billing_to">{{ $billing->address ? $billing->address->name : null }}</dd>
                        <dd class="dd-billing-description">{{ $billing->description }}</dd>
                    </dl>    
                </dd>
            @endforeach
        @else
            <dd>現在登録されている請求先はありません</dd>
        @endif
    </dl>
</section>
<section id="address">
    <h3>address</h3>
    <dl id="dl-addresses">
        <dt>
            <dl class="dl-flex dl-address-header">
                <dd class="dd-address-name">name</dd>
                <dd class="dd-address-zip_code">zip_code</dd>
                <dd class="dd-address-prefecture">prefecture</dd>
                <dd class="dd-address-city">city</dd>
                <dd class="dd-address-town">town</dd>
                <dd class="dd-address-other">other</dd>
                <dd class="dd-address-button">button</dd>
            </dl>
        </dt>
        @if ($company->addresses->isNotEmpty())
            @foreach ($company->addresses as $address)
                <dd>
                    <dl class="dl-flex dl-address-content">
                        <dd class="dd-address-name">{{ $address->name }}</dd>
                        <dd class="dd-address-zip_code">{{ $address->zip_code }}</dd>
                        <dd class="dd-address-prefecture">{{ $address->prefecture }}</dd>
                        <dd class="dd-address-city">{{ $address->city }}</dd>
                        <dd class="dd-address-town">{{ $address->town }}</dd>
                        <dd class="dd-address-other">{{ $address->other }}</dd>
                        <dd class="dd-address-button">
                            <button type="button" onclick="edit_address(this);">編集</button>
                            @if (array_intersect(array("all","provider"), auth()->user()->roles("kbox")))
                            <button onclick="confirm('この住所紐づけられているデータはすべて消えます。削除していいですか？') ? location.href = '/kbox/company/{{ $company->id }}/address/{{ $address->id }}/delete' : null">削除</button>
                                {{-- <button onclick="confirm('この住所紐づけられているデータはすべて消えます。削除していいですか？') ? console.log('ほげ') : null">削除</button> --}}
                            @endif
                        </dd>
                    </dl>
                </dd>
            @endforeach
        @else
            <dd>現在登録されている住所はありません</dd>
        @endif
        <dd>
            <form id="form-address" action="/kbox/company/{{ $company->id }}/address" method="post" class="h-adr">
                <span class="p-country-name hidden">Japan</span>
                @csrf
                <dl class="dl-flex dl-address-form">
                    <dd class="dd-address-name"><input type="text" name="name" required></dd>
                    <dd class="dd-address-zip_code"><input type="text" name="zip_code[0]" class="p-postal-code" size="3" maxlength="3" required>-<input type="text" name="zip_code[1]" class="p-postal-code" size="4" maxlength="4" required></dd>
                    <dd class="dd-address-prefecture"><input type="text" name="prefecture" class="p-region readonly" readonly></dd>
                    <dd class="dd-address-city"><input type="text" name="city" class="p-locality readonly" readonly></dd>
                    <dd class="dd-address-town"><input type="text" name="town" class="p-street-address p-extended-address"></dd>
                    <dd class="dd-address-other"><textarea name="other" rows="3"></textarea></dd>
                    <dd class="dd-address-button">
                        <button type="submit">追加</button>
                        <button type="button" onclick="clear_form(this);">クリア</button>
                    </dd>
                </dl>
            </form>
        </dd>
</section>
<section id="contact">
    <h3>contact</h3>
    <dl id="dl-contacts">
        <dt>
            <dl class="dl-flex dl-contact-header">
                <dd class="dd-contact-type">type</dd>
                <dd class="dd-contact-category">category</dd>
                <dd class="dd-contact-name">name</dd>
                <dd class="dd-contact-value">value</dd>
                <dd class="dd-contact-description">description</dd>
                <dd class="dd-contact-button">button</dd>
            </dl>
        </dt>
        @if ($company->contacts->isNotEmpty())
            @foreach ($company->contacts as $contact)
                <dd>
                    <dl class="dl-flex">
                        <dd class="dd-contact-type">{{ $contact->type }}</dd>
                        <dd class="dd-contact-category">{{ $contact->category }}</dd>
                        <dd class="dd-contact-name">{{ $contact->name }}</dd>
                        <dd class="dd-contact-value">{{ $contact->value }}</dd>
                        <dd class="dd-contact-description">{{ $contact->description }}</dd>
                        <dd class="dd-contact-button">
                            <button type="button" onclick="edit_contact(this);">編集</button>
                            @if (array_intersect(array("all","provider"), auth()->user()->roles("kbox")))
                                <button onclick="confirm('この連絡先に紐づけられているデータはすべて消えます。削除していいですか？') ? location.href = '/kbox/company/{{ $company->id }}/contact/{{ $contact->id }}/delete' : null">削除</button>
                            @endif
                        </dd>

                    </dl>
                </dd>
            @endforeach
        @else
            <dd>現在登録されている連絡先はありません</dd>
        @endif
        <dd>
            <form id="form-contact" action="/kbox/company/{{ $company->id }}/contact" method="post">
                @csrf
                <dl class="dl-flex dl-contact-form">                
                    <dd class="dd-contact-type">
                        <input type="text" name="type" list="form-contact-datalist-type" required>
                        <datalist id="form-contact-datalist-type">
                            <option value="tel"></option>
                            <option value="fax"></option>
                            <option value="email"></option>
                            <option value="website"></option>
                        </datalist>
                    </dd>
                    <dd class="dd-contact-category"><input type="text" name="category"></dd>
                    <dd class="dd-contact-name"><input type="text" name="name"></dd>
                    <dd class="dd-contact-value"><input type="text" name="value"></dd>
                    <dd class="dd-contact-description">
                        <textarea name="description" rows="3"></textarea>
                    </dd>
                    <dd class="dd-contact-button">
                        <button type="submit">追加</button>
                        <button type="button" onclick="clear_form(this);">クリア</button>
                    </dd>
                </dl>
            </form>
        </dd>

</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script">
    <script>
        function edit_address(button){
            const form  =   document.getElementById("form-address");
            const dl    =   button.closest("dl");
            form.querySelector("input[name='name']").readOnly       =   true;
            form.querySelector("input[name='name']").classList.add("readonly");
            form.querySelector("input[name='name']").value          =   dl.querySelector("dd.dd-address-category").textContent;
            form.querySelector("input[name='zip_code[0]']").value   =   dl.querySelector("dd.dd-address-zip_code").textContent.split("-")[0];
            form.querySelector("input[name='zip_code[1]']").value   =   dl.querySelector("dd.dd-address-zip_code").textContent.split("-")[1];
            form.querySelector("input[name='prefecture']").value    =   dl.querySelector("dd.dd-address-prefecture").textContent;
            form.querySelector("input[name='city']").value          =   dl.querySelector("dd.dd-address-city").textContent;
            form.querySelector("input[name='town']").value          =   dl.querySelector("dd.dd-address-town").textContent;
            form.querySelector("textarea[name='other']").value      =   dl.querySelector("dd.dd-address-other").textContent;
        }

        function edit_contact(button){
            const form  =   document.getElementById("form-contact");
            const dl    =   button.closest("dl");
            ["category","type","value","name","description"].forEach(column =>{
                const input =   form.querySelector(`input[name="${column}"], select[name="${column}"], textarea[name="${column}"]`);
                const value =   dl.querySelector(`dd.dd-contact-${column}`).textContent;
                if(input){
                    input.value =   value;
                    if(["category","type", "name"].includes(input.name)){
                        input.readOnly  =   true;
                        input.classList.add("readonly");
                    }
                }
            });
        }



        function clear_form(button){
            const form  =   button.closest("form");
            form.querySelectorAll("input, textarea").forEach(input => {
                if(input.name == "_token") {
                    return;
                }
                if(form.id == "form-address" && input.name == "name") {
                    input.readOnly  =   false;
                    input.classList.remove("readonly");
                }
                if(form.id == "form-contact") {
                    input.readOnly  =   false;
                    input.classList.remove("readonly");
                }
                input.value = null;
            });
        }
    </script>
</x-slot>
</x-kbox.frame.basic>