<x-website.frame.edit>
<x-slot name="title">layout</x-slot>
<x-slot name="id">layout</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/layout">layout</a> > {{ $type }}</x-slot>
<section id="create">
    <h3><a href="/edit/layout/{{ $type }}">{{ $title }}</a></h3>
    <form action="/edit/layout/{{ $type }}" method="post">
        @csrf
        <p><button type="submit">save</button></p>
        @foreach (array("header", "main", "footer") as $target)
            <h4>{{ $target }}</h4>
            <dl>
                <dt>
                    <dl></dl>
                </dt>
                <dd>
                    <dl id="dl-layout-create-body-{{ $target }}" class="dl-layout-create-body-{{ $target }}">
                        @if (isset($layouts[$target]))
                            @foreach ($layouts[$target] as $index => $layout)
                                <dd id="dd-layout-create-body-{{ $target }}-{{ $index }}">
                                    <dl class="dl-flex">
                                        <dd>
                                            <select name="{{ $target }}[{{ $index }}][type]" onchange="select_type(this);">
                                                <option value="">---</option>
                                                @foreach ($types as $key => $value)
                                                    <option value="{{ $key }}" @selected(isset($layout->page) && $key == $layout->page->type)>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dd>
                                            <select name="{{ $target }}[{{ $index }}][page]">
                                                <option value="" data-type="all">---</option>
                                                @foreach ($pages as $page)
                                                    <option class="{{ isset($layout->page) && $layout->page->type == $page->type ? null : "hidden" }}" value="{{ $page->id }}" data-type="{{ $page->type }}" @selected(isset($layout->page) && $layout->page->id == $page->id)>{{ $page->title }}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dd>
                                            <select name="{{ $target }}[{{ $index }}][option]">
                                                <option value="default" data-type="all" @selected($layout->option == "default")>デフォルト</option>
                                                @foreach ($options as $option_type => $option)
                                                    @foreach ($option as $option_key => $option_value)
                                                        <option class="{{ isset($layout->page) && $layout->page->type == $option_type ? null : "hidden" }}" value="{{ $option_key }}" data-type="{{ $option_type }}" @selected($layout->option == $option_key)>{{ $option_value }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dd><input type="number" class="hidden" name="{{ $target }}[{{ $index }}][order]" value="{{ $index + 1 }}"></dd>
                                        <dd>
                                            <dl class="dl-flex">
                                                <dd><button type="button" onclick="up('{{ $target }}' ,{{ $index }});">↑</button></dd>
                                                <dd><button type="button" onclick="down('{{ $target }}' ,{{ $index }});">↓</button></dd>
                                                <dd><button type="button" onclick="remove('{{ $target }}' ,{{ $index }});">×</button></dd>
                                            </dl>
                                        </dd>
                                    </dl>
                                </dd>
                            @endforeach
                        @endif
                    </dl>
                </dd>
                <dd>
                    <dl class="dl-flex dl-layout-create-footer-{{ $target }}">
                        <dd><button type="button" onclick="add('{{ $target }}');">add</button></dd>
                        <dd id="dd-layout-create-body-{{ $target }}-sumple" class="hidden">
                            <dl class="dl-flex">
                                <dd>
                                    <select name="{{ $target }}[num][type]" onchange="select_type(this);">
                                        <option value="">---</option>
                                        @foreach ($types as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </dd>
                                <dd>
                                    <select name="{{ $target }}[num][page]" disabled>
                                        <option value="" data-type="all">---</option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id }}" data-type="{{ $page->type }}">{{ $page->title }}</option>
                                        @endforeach
                                    </select>
                                </dd>
                                <dd>
                                    <select name="{{ $target }}[num][option]" disabled>
                                        <option value="default" data-type="all">デフォルト</option>
                                        @foreach ($options as $option_type => $option)
                                            @foreach ($option as $option_key => $option_value)
                                                <option  value="{{ $option_key }}" data-type="{{ $option_type }}">{{ $option_value }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </dd>
                                <dd><input type="number" class="hidden" name="{{ $target }}[num][order]"></dd>
                                <dd>
                                    <dl class="dl-flex">
                                        <dd><button type="button" onclick="up('{{ $target }}' ,'num');">↑</button></dd>
                                        <dd><button type="button" onclick="down('{{ $target }}' ,'num');">↓</button></dd>
                                        <dd><button type="button" onclick="remove('{{ $target }}' ,'num');">×</button></dd>
                                    </dl>
                                </dd>
                            </dl>
                        </dd>
                    </dl>
                </dd>    
            </dl>
        @endforeach
    </form>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script">
    <script>
        const count =   {
            "header"    :   {{ isset($layouts["header"]) ? $layouts["header"]->count(): 0 }},
            "main"      :   {{ isset($layouts["main"]) ? $layouts["main"]->count(): 0 }},
            "footer"    :   {{ isset($layouts["footer"]) ? $layouts["footer"]->count(): 0 }},
        }

        function up(target, num){
            const dl            =   document.getElementById("dl-layout-create-body-" + target);
            const dd            =   document.getElementById("dd-layout-create-body-" + target + "-" + num);
            const previous_dd   =   dd.previousElementSibling;
            previous_dd ? dl.insertBefore(dd, previous_dd) : null;
            order(target);
        }
        function down(target, num){
            const dl            =   document.getElementById("dl-layout-create-body-" + target);
            const dd            =   document.getElementById("dd-layout-create-body-" + target + "-" + num);
            const next_dd   =   dd.nextElementSibling;
            next_dd ? dl.insertBefore(next_dd, dd) : null;
            order(target);
        }
        function remove(target, num){
            const dl            =   document.getElementById("dl-layout-create-body-" + target);
            const dd            =   document.getElementById("dd-layout-create-body-" + target + "-" + num);
            dd.remove();
            order(target);
        }
        function add(target){
            const dl        =   document.getElementById("dl-layout-create-body-" + target);
            const num       =   count[target]++;
            const sumple    =   document.getElementById("dd-layout-create-body-" + target + "-sumple");
            const dd        =   sumple.cloneNode(sumple);
                dd.removeAttribute("class");
                dd.setAttribute("id", "dd-layout-create-body-"+ target + "-" + num);
                dd.querySelectorAll("select").forEach(input => input.setAttribute("name", input.getAttribute("name").replace("num", num)));
                dd.querySelectorAll("input").forEach(input => input.setAttribute("name", input.getAttribute("name").replace("num", num)));
                dd.querySelectorAll("button").forEach(button => button.setAttribute("onclick", button.getAttribute("onclick").replace("'num'", num)));
            dl.insertBefore(dd, null);
            order(target);
        }
        function order(target){
            console.log(target, "order");
            const dl    =   document.getElementById("dl-layout-create-body-" + target);
            dl.querySelectorAll("input[name^='"+ target + "'][name$='[order]']").forEach((input, index) => input.value  =   index + 1);
        }

        function select_type(type_select){
            const name          =   type_select.name;
            const type          =   type_select.value;
            const page_select   =   document.querySelector("select[name='"+ name.replace("type","page") + "']");
            const page_selected =   page_select.options[page_select.selectedIndex];
            page_select.querySelectorAll("option").forEach(option => {
                const data_type =   option.getAttribute("data-type");
                if(type == ""){
                    page_select.disabled    =   true;
                    page_select.value       =   "";
                    option.classList.add("hidden");
                }
                if(type != ""){
                    page_select.disabled    =   false;
                    if(type != page_selected.getAttribute("data-type")){
                        page_select.value   =   "";
                    }
                    data_type == "all" || data_type == type ? option.classList.remove("hidden") : option.classList.add("hidden");
                }
            });
            const option_select     =   document.querySelector("select[name='"+ name.replace("type","option") + "']");
            const option_selected   =   page_select.options[page_select.selectedIndex];
            option_select.querySelectorAll("option").forEach(option => {
                const data_type =   option.getAttribute("data-type");
                if(type == ""){
                    option_select.disabled  =   true;
                    option_select.value     =   "default";
                    option.classList.add("hidden");
                }
                if(type != ""){
                    option_select.disabled  =   false;
                    if(type != option_selected.getAttribute("data-type")){
                        option_select.value =   "default";
                    }
                    data_type == "all" || data_type == type ? option.classList.remove("hidden") : option.classList.add("hidden");
                }
            });

        }
    </script>
</x-slot>    
</x-website.frame.edit>