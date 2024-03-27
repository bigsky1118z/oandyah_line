@php
    $values =   array();
    if(isset($page)){
        $columns    =   array("id","path","title","status","valid_at","expired_at");
        foreach ($columns as $column) {
            $values["page_" . $column]  =   $page[$column];
        }
    }
    if(isset($forms)){
        $values["form"] =   array();
        foreach ($forms as $index => $form) {
            $values["form"][$index] =   array(
                "id"            =>  $form->id,
                "active"        =>  $form->active,
                "name"          =>  $form->name,
                "title"         =>  $form->title,
                "type"          =>  $form->type,
                "description"   =>  $form->description,
                "required"      =>  $form->required,
            );
        }
    }
    if(count(old())) {
        $values =   old();
    }
    $count  =   1;
@endphp
<x-website.frame.edit>
<x-slot name="title">contact</x-slot>
<x-slot name="id">contact</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/contact">問い合わせ</a> > {!! isset($values["page_id"]) && isset($values["page_title"]) ? "<a href='/edit/page/contact/" . $values["page_id"] . "/edit'>". $values["page_title"] . "</a> > form" : null !!}</x-slot>
@if (isset($page))
<section id="form">
    <h4>リンク</h4>
    <form action="/edit/page/contact/{{ $values["page_id"] }}/form" method="post">
        @csrf
        <dl id="dl-contact-form">
            <dt>
                <dl class="dl-flex dl-contact-form-header">
                    <dd class="dd-contact-form-active">有効</dd>
                    <dd class="dd-contact-form-name">項目</dd>
                    <dd class="dd-contact-form-title">タイトル</dd>
                    <dd class="dd-contact-form-description">説明</dd>
                    <dd class="dd-contact-form-required">必須</dd>
                    <dd class="dd-contact-form-order">序列</dd>
                    <dd class="dd-contact-form-button">操作</dd>
                </dl>
            </dt>
            <dd>
                <dl id="dl-contact-form-body" class="dl-contact-form-body">
                    @if (isset($values["form"]) && count($values["form"]))
                        @foreach ($values["form"] as $index => $form)
                            @if (isset($form_values[$form["name"]], $form_values[$form["name"]]["title"]))
                                <dd id="dd-contact-form-body-{{ $form["name"] }}">
                                    <dl class="dl-flex">
                                        <dd class="dd-contact-form-active">
                                            <input type="checkbox" name="form[{{ $form["name"] }}][active]" @checked($form["active"])>
                                        </dd>
                                        <dd class="dd-contact-form-name">{{ $form_values[$form["name"]]["title"] }}</dd>
                                        <dd class="dd-contact-form-title">
                                            <input type="text" name="form[{{ $form["name"] }}][title]" value="{{  $form["title"] ? $form["title"] : $form_values[$form["name"]]["title"] }}">
                                        </dd>
                                        <dd class="dd-contact-form-description">
                                            <textarea name="form[{{ $form["name"] }}][description]">{{ $form["description"] ? $form["description"] : $form_values[$form["name"]]["title"] . "を入力してください" }}</textarea></dd>
                                        <dd class="dd-contact-form-required">
                                            <input type="checkbox" name="form[{{ $form["name"] }}][required]" @checked($form["required"])>
                                        </dd>
                                        <dd class="dd-contact-form-order">
                                            <input type="number" name="form[{{ $form["name"] }}][order]" value="{{ $count }}">
                                        </dd>
                                        <dd class="dd-contact-form-button">
                                            <dl class="dl-flex flex-center">
                                                <dd><button type="button" onclick="up('{{ $form['name'] }}')";>↑</button></dd>
                                                <dd><button type="button" onclick="down('{{ $form['name'] }}')";>↓</button></dd>
                                            </dl>
                                        </dd>
                                    </dl>
                                </dd>
                                @php
                                    unset($form_values[$form["name"]]);
                                @endphp
                            @endif
                        @endforeach
                        @foreach ($form_values as $form_name => $form_value)
                            @if (isset($form_value["title"]))
                                <dd id="dd-contact-form-body-{{ $form_name }}">
                                    <dl class="dl-flex">
                                        <dd class="dd-contact-form-active">
                                            <input type="checkbox" name="form[{{ $form_name }}][active]">
                                        </dd>
                                        <dd class="dd-contact-form-name">{{ $form_value["title"] }}</dd>
                                        <dd class="dd-contact-form-title">
                                            <input type="text" name="form[{{ $form_name }}][title]" value="{{ $form_value["title"] }}">
                                        </dd>
                                        <dd class="dd-contact-form-description">
                                            <textarea name="form[{{ $form_name }}][description]">{{ $form_value["title"] }}を入力してください</textarea>
                                        </dd>
                                        <dd class="dd-contact-form-required">
                                            <input type="checkbox" name="form[{{ $form_name }}][required]">
                                        </dd>
                                        <dd class="dd-contact-form-order">
                                            <input type="number" name="form[{{ $form_name }}][order]" value="{{ $count++ }}">
                                        </dd>
                                        <dd class="dd-contact-form-button">
                                            <dl class="dl-flex flex-center">
                                                <dd><button type="button" onclick="up('{{ $form_name }}');">↑</button></dd>
                                                <dd><button type="button" onclick="down('{{ $form_name }}');">↓</button></dd>
                                            </dl>
                                        </dd>
                                    </dl>
                                </dd>
                            @endif
                        @endforeach
                    @endif
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-contact-form-footer">
                    <dd><button type="submit">save</button></dd>
                </dl>
            </dd>
        </dl>
    </form>
</section>
@endif
<x-slot name="script">
    <script>
        const dl    =   document.getElementById("dl-contact-form-body");
        function up(name){
            const dd            =   document.getElementById("dd-contact-form-body-" + name);
            const previous_dd   =   dd.previousElementSibling;
            previous_dd ? dl.insertBefore(dd, previous_dd) : null;
            order();
        }
        function down(name){
            const dd        =   document.getElementById("dd-contact-form-body-" + name);
            const next_dd   =   dd.nextElementSibling;
            next_dd ? dl.insertBefore(next_dd, dd) : null;
            order();
        }
        function order(){
            console.log("order");
            dl.querySelectorAll("input[name^='form'][name$='[order]']").forEach((input, index) => input.value  =   index + 1);
        }
    </script>
</x-slot>
</x-website.frame.edit>