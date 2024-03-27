<x-website.frame.edit title="トップページのレイアウト">
@csrf
<h2>トップページのレイアウト</h2>
<p><a href="/edit/layout" class="button button-create">一覧へ戻る</a></p>
<section>
</section>
@foreach ($grouped_layouts as $section => $layouts)
    <section>
        <h3>{{ $sections[$section] }}の編集</h3>
        <form>
            <dl class="dl-flex-left dl-header">
                <dt class="layout-page-category">ページ</dt>
                <dt class="layout-page-title">カテゴリ</dt>
                <dt class="layout-option">オプション</dt>
                <dt class="layout-buttons">操作</dt>
            </dl>
            @foreach ($layouts as $layout)
                <dl class="dl-flex-left" data-section="{{ $layout->section }}" data-id="{{ $layout->id }}">
                    <dd class="layout-page-category">{{ $layout->page->category == "function" && $layout->page->function ? "function[".$layout->page->function->value."]" : $layout->page->category }}</dd>
                    <dd class="layout-page-title">{{ $layout->page->title }}</dd>
                    <dd class="layout-option">{{ $layout->option }}</dd>
                    <dd class="layout-button"><button type="button" class="button button-order" onclick="edit(this, 'up');">↑</button></dd>
                    <dd class="layout-button"><button type="button" class="button button-order" onclick="edit(this, 'down');">↓</button></dd>
                    <dd class="layout-button"><button type="button" class="button button-delete" onclick="edit(this, 'delete');">×</button></dd>
                </dl>
            @endforeach
        </form>
        <form>
            <dl class="dl-flex-left">
                <dd class="layout-page-category">
                    <select name="category" onchange="sort(this);">
                        <option value="">絞り込み</option>
                        @foreach ($categories as $key => $category)
                            <option value="{{ $key }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </dd>
                <dd class="layout-page-title">
                    <select name="page" disabled>
                        <option value="">---</option>
                        @foreach ($pages as $page)
                            <option data-category="{{ $page->category }}" value="{{ $page->id }}">{{ $page->title }}</option>
                        @endforeach
                    </select>
                </dd>
                <dd class="layout-option">
                    <select name="option" disabled>
                        <option value="">---</option>
                        @foreach ($options as $option_category => $option)
                            @foreach ($option as $key => $value)
                                <option data-category="{{ $option_category }}" value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </dd>
                <dd class="layout-buttons"><button type="button" class="button button-create" onclick="add(this, '{{ $section }}');" >追加</button></dd>
            </dl>
        </form>
    </section>
@endforeach
<x-slot name="script">
    <script>
        function edit(button, direction){
            const dl    =   button.closest("dl");
            const id    =   dl.getAttribute("data-id");
            if(direction == "delete"){
                fetch(`/edit/layout/top/${id}/delete`).then(response=>response.ok ? window.location.reload() : null);
            }
            if(direction == "up" || direction == "down"){
                const form      =   button.closest("form");
                const self      =   button.closest("dl");
                let target      =   null;
                if(direction == "up"){
                    target  =   self.previousElementSibling;
                }
                if(direction == "down"){
                    target  =   self.nextElementSibling;
                }
                if(target && !target.classList.contains("dl-header")){
                    direction == "up"   ?   form.insertBefore(self, target) :   null;
                    direction == "down" ?   form.insertBefore(target, self) :   null;

                    const formData  =   new FormData();
                        formData.append("_token", document.querySelector("input[name=_token]").value);
                        formData.append("section", self.getAttribute("data-section"));
                        formData.append("self", self.getAttribute("data-id"));
                        formData.append("target", target.getAttribute("data-id"));
                    const options   =   {
                        "method"    :   "post",
                        "body"      :   formData,
                    }
                    fetch("/edit/layout/top/order", options).then(response=>response.json()).then(data=>console.log(data)).catch(error=>console.error(error));
                }
                
            }
        }
        function add(button, section) {
            const form      =   button.closest("form");
            const id        =   form.querySelector("select[name=page]").value;
            const option    =   form.querySelector("select[name=option]").value;
            if(section && id){
                console.log(section,id,option);
                const formData  =   new FormData();
                    formData.append("_token", document.querySelector("input[name=_token]").value);
                    formData.append("section", section);
                    formData.append("id", id);
                    if(option){
                        formData.append("option", option);
                    }
                const options   =   {
                    "method"    :   "post",
                    "body"      :   formData,
                }
                for(let data of formData.entries()){
                    console.log(data);
                }
                fetch("/edit/layout/top", options).then(response=>response.ok ? window.location.reload() : null);
            }
        }
        function sort(select) {
            const value     =   select.value;
            ["page","option"].forEach(name =>{
                const target    =   select.closest("dl").querySelector(`dd > select[name="${name}"]`);
                if(value){
                    target.disabled =   false;
                    target.querySelectorAll("option").forEach((option) =>{
                        value && option.getAttribute("data-category") && option.getAttribute("data-category") != value ? option.classList.add("hidden") : option.classList.remove("hidden");
                    });
                    const selected  =   target.options[target.selectedIndex];
                    value && selected.getAttribute("data-category") != value ? target.value = "" : null;
                } else {
                    target.value    =   "";
                    target.disabled =   true;
                }
            });
        }
    </script>
</x-slot>
</x-website.frame.edit>