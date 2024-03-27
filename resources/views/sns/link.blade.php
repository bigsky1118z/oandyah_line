<x-sns.frame.basic>
<x-slot name="id">link</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="description"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<section id="link">
    <form action="/sns/{{ $sns->name }}/link" method="post">
        @csrf
        <dl id="dl-sns-link">
            <dt class="dt-sns-link-header">
                <dl>
                    <dd class="dd-sns-link-group">
                        <dl class="dl-sns-link-group-0">
                            <dd class="dd-sns-link-active"></dd>
                            <dd class="dd-sns-link-order">順番</dd>
                        </dl>
                        <dl class="dl-sns-link-group-1">
                            <dd class="dd-sns-link-type">SNS</dd>
                            <dd class="dd-sns-link-value">SNS ID</dd>
                        </dl>
                        <dl class="dl-sns-link-group-2">
                            <dd class="dd-sns-link-title">表記</dd>
                            <dd class="dd-sns-link-description">説明</dd>
                        </dl>
                        <dl class="dl-sns-link-group-3">
                            {{-- <dd class="dd-sns-link-image_url_submnail">image_url_submnail</dd> --}}
                            {{-- <dd class="dd-sns-link-image_url_header">image_url_header</dd> --}}
                        </dl>
                        <dl class="dl-sns-link-group-button">
                            <dd>操作</dd>
                        </dl>
                    </dd>
                </dl>
            </dt>
            <dd class="dd-sns-link-body">
                <dl id="dl-sns-link-body">
                    @foreach ($sns->links as $index => $link)
                        <dd class="dd-sns-link-group{{$link->active ?  ' dd-sns-link-group-active' : null }}" id="dd-sns-link-{{ $index + 1 }}">
                            <dl class="dl-sns-link-group-0">
                                <dd class="dd-sns-link-active">
                                    <span class="sp-sns-link-title">表示</span>
                                    <input type="checkbox" name="link[{{ $index + 1 }}][active]" onclick="isActive(this);" @checked($link->active)>
                                </dd>
                                <dd class="dd-sns-link-order">
                                    <span class="sp-sns-link-title">順番</span>
                                    <input type="number" name="link[{{ $index + 1 }}][order]" value="{{ $index + 1 }}">
                                </dd>
                            </dl>
                            <dl class="dl-sns-link-group-1">
                                <dd class="dd-sns-link-type">
                                    <span class="sp-sns-link-title">SNS</span>
                                    <select name="link[{{ $index + 1 }}][type]">
                                        @foreach ($types as $type_value => $type_title)
                                            <option value="{{ $type_value }}" @selected($link->type == $type_value)>{{ $type_title }}</option>
                                        @endforeach
                                    </select>
                                </dd>
                                <dd class="dd-sns-link-value">
                                    <span class="sp-sns-link-title">SNS ID</span>
                                    <input type="text" name="link[{{ $index + 1 }}][value]" value="{{ $link->value }}">
                                </dd>
                            </dl>
                            <dl class="dl-sns-link-group-2">
                                <dd class="dd-sns-link-title">
                                    <span class="sp-sns-link-title">表記</span>
                                    <input type="text" name="link[{{ $index + 1 }}][title]" value="{{ $link->title }}">
                                </dd>
                                <dd class="dd-sns-link-description">
                                    <span class="sp-sns-link-title">説明</span>
                                    <textarea name="link[{{ $index + 1 }}][description]">{{ $link->description }}</textarea>
                                </dd>
                            </dl>
                            <dl class="dl-sns-link-group-3">
                                {{-- <dd class="dd-sns-link-image_url_submnail"><span class="sp-sns-link-title">span</span>{{ $link->image_url_submnail }}</dd> --}}
                                {{-- <dd class="dd-sns-link-image_url_header"><span class="sp-sns-link-title">span</span>{{ $link->image_url_header }}</dd> --}}
                            </dl>
                            <dl class="dl-sns-link-group-button">
                                <dd class="dd-sns-link-up"><button type="button" onclick="up(this);">↑</button></dd>
                                <dd class="dd-sns-link-down"><button type="button" onclick="down(this);">↓</button></dd>
                                <dd class="dd-sns-link-remove"><button type="button" onclick="remove(this);">×</button></dd>
                            </dl>
                        </dd>
                    @endforeach
                </dl>
            </dd>
            <dd class="dd-sns-link-footer">
                <dl>
                    <dd class="dd-sns-link-group">
                        <dl class="dl-sns-link-group-action">
                            <dd><button type="button" onclick="add();">追加</button></dd>
                            <dd><button type="submit">保存</button></dd>
                        </dl>
                    </dd>
                    <dd class="dd-sns-link-group" id="dd-sns-link-sumple">
                        <dl class="dl-sns-link-group-0">
                            <dd class="dd-sns-link-active">
                                <span class="sp-sns-link-title">表示</span>
                                <input type="checkbox" name="link[sumple][active]" onclick="isActive(this);">
                            </dd>
                            <dd class="dd-sns-link-order">
                                <span class="sp-sns-link-title">順番</span>
                                <input type="number" name="link[sumple][order]">
                            </dd>
                        </dl>
                        <dl class="dl-sns-link-group-1">
                            <dd class="dd-sns-link-type">
                                <span class="sp-sns-link-title">SNS</span>
                                <select name="link[sumple][type]">
                                    @foreach ($types as $type_value => $type_title)
                                        <option value="{{ $type_value }}">{{ $type_title }}</option>
                                    @endforeach
                                </select>
                            </dd>
                            <dd class="dd-sns-link-value">
                                <span class="sp-sns-link-title">SNS ID</span>
                                <input type="text" name="link[sumple][value]">
                            </dd>
                        </dl>
                        <dl class="dl-sns-link-group-2">
                            <dd class="dd-sns-link-title">
                                <span class="sp-sns-link-title">表記</span>
                                <input type="text" name="link[sumple][title]">
                            </dd>
                            <dd class="dd-sns-link-description">
                                <span class="sp-sns-link-title">説明</span>
                                <textarea name="link[sumple][description]"></textarea>
                            </dd>
                        </dl>
                        <dl class="dl-sns-link-group-3">
                            {{-- <dd class="dd-sns-link-image_url_submnail"><span class="sp-sns-link-title">span</span></dd> --}}
                            {{-- <dd class="dd-sns-link-image_url_header"><span class="sp-sns-link-title">span</span></dd> --}}
                        </dl>
                        <dl class="dl-sns-link-group-button">
                            <dd><button type="button" onclick="up(this);">↑</button></dd>
                            <dd><button type="button" onclick="down(this);">↓</button></dd>
                            <dd><button type="button" onclick="remove(this);">×</button></dd>
                        </dl>
                    </dd>
                </dl>
                </dl>
            </dd>
        </dl>
    </form>
</section>
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script">
    <script>
        let count   =   {{ $sns->links->count() }};
        function order(){
            const dl    =   document.getElementById("dl-sns-link-body");
            dl.querySelectorAll("input[name^='link'][name$='[order]']").forEach((input, index) => input.value = index + 1);
        }

        function up(button){
            const dl            =   document.getElementById("dl-sns-link-body");
            const dd            =   button.closest("dd.dd-sns-link-group");
            const previous_dd   =   dd.previousElementSibling;
            previous_dd ? dl.insertBefore(dd, previous_dd) : null;
            order();
        }
        function down(button){
            const dl        =   document.getElementById("dl-sns-link-body");
            const dd        =   button.closest("dd.dd-sns-link-group");
            const next_dd   =   dd.nextElementSibling;
            next_dd ? dl.insertBefore(next_dd, dd) : null;
            order();
        }
        function remove(button){
            button.closest("dd.dd-sns-link-group").remove();
            order();
        }
        function add(){
            count++;
            const dd    =   document.getElementById("dd-sns-link-sumple").cloneNode(true);
                dd.setAttribute("id", "dd-sns-link-" + count);
                dd.querySelectorAll("input, select, textarea").forEach(input => input.setAttribute("name", input.getAttribute("name").replace("sumple", count)));
            const dl    =   document.getElementById("dl-sns-link-body");
            dl.insertBefore(dd, null);
            order();
        }
        function isActive(checkbox){
            const dd    =   checkbox.closest("dd.dd-sns-link-group");
            checkbox.checked ? dd.classList.add("dd-sns-link-group-active") : dd.classList.remove("dd-sns-link-group-active");

            console.log(checkbox);
            console.log(dd.classList);
        }
    </script>
</x-slot>
</x-sns.frame.basic>