@php
    $values =   array();
    if(isset($page)){
        $columns    =   array("id","path","title","status","valid_at","expired_at");
        foreach ($columns as $column) {
            $values["page_" . $column]  =   $page[$column];
        }
    }
    if(isset($links)){
        $values["link"] =   array();
        foreach ($links as $index => $link) {
            $values["link"][$index] =   array(
                "id"                    =>  $link->id,
                "path"                  =>  $link->path,
                "title"                 =>  $link->title,
                "description"           =>  $link->description,
                "image_thumbnail_url"   =>  $link->image_thumbnail_url,
            );
        }
    }
    if(count(old())) {
        $values =   old();
    }
@endphp
<x-website.frame.edit>
<x-slot name="title">menu</x-slot>
<x-slot name="id">menu</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/menu">メニューページ</a> > {!! isset($values["page_id"]) && isset($values["page_title"]) ? "<a href='/edit/page/menu/" . $values["page_id"] . "/edit'>". $values["page_title"] . "</a> > link" : null !!}</x-slot>
@if (isset($page))
<section id="link">
    <h4>リンク</h4>
    <form action="/edit/page/menu/{{ $values["page_id"] }}/link" method="post">
        @csrf
        <dl id="dl-menu-link">
            <dt>
                <dl class="dl-flex dl-menu-link-header">
                    <dd class="dd-menu-link-path">path</dd>
                    <dd class="dd-menu-link-title">title</dd>
                    <dd class="dd-menu-link-thumbnail">thumbnail</dd>
                    <dd class="dd-menu-link-description">description</dd>
                    <dd class="dd-menu-link-order">oroder</dd>
                    <dd class="dd-menu-link-button">button</dd>
                </dl>
            </dt>
            <dd>
                <dl id="dl-menu-link-body" class="dl-menu-link-body">
                    @if (isset($values["link"]) && count($values["link"]))
                        @foreach ($values["link"] as $index => $link)
                            <dd id="dd-menu-link-body-{{ $index }}">
                                <dl class="dl-flex">
                                    <dd class="dd-menu-link-path"><input type="text" name="link[{{ $index }}][path]" value="{{ $link["path"] }}"></dd>
                                    <dd class="dd-menu-link-title"><input type="text" name="link[{{ $index }}][title]" value="{{ $link["title"] }}"></dd>
                                    <dd class="dd-menu-link-thumbnail"><input type="text" name="link[{{ $index }}][image_thumbnail_url]" value="{{ $link["image_thumbnail_url"] }}"></dd>
                                    <dd class="dd-menu-link-description"><textarea name="link[{{ $index }}][description]">{{ $link["description"] }}</textarea></dd>
                                    <dd class="dd-menu-link-order"><input type="number" name="link[{{ $index }}][order]" value="{{ $index + 1 }}"></dd>
                                    <dd class="dd-menu-link-button">
                                        <dl class="dl-flex flex-center">
                                            <dd><button type="button" onclick="up({{ $index }});">↑</button></dd>
                                            <dd><button type="button" onclick="down({{ $index }});">↓</button></dd>
                                            <dd><button type="button" onclick="remove({{ $index }});">×</button></dd>
                                        </dl>
                                    </dd>
                                </dl>
                            </dd>
                        @endforeach
                    @endif
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-menu-link-footer">
                    <dd><button type="button" onclick="add();">add</button></dd>
                    <dd><button type="submit">save</button></dd>
                    <dd id="dd-menu-link-body-sumple" class="hidden">
                        <dl class="dl-flex">
                            <dd class="dd-menu-link-path"><input type="text" name="link[num][path]"></dd>
                            <dd class="dd-menu-link-title"><input type="text" name="link[num][title]"></dd>
                            <dd class="dd-menu-link-thumbnail"><input type="text" name="link[num][image_thumbnail_url]"></dd>
                            <dd class="dd-menu-link-description"><textarea name="link[num][description]"></textarea></dd>
                            <dd class="dd-menu-link-order"><input type="number" name="link[num][order]"></dd>
                            <dd class="dd-menu-link-button">
                                <dl class="dl-flex">
                                    <dd><button type="button" onclick="up('num');">↑</button></dd>
                                    <dd><button type="button" onclick="down('num');">↓</button></dd>
                                    <dd><button type="button" onclick="remove('num');">×</button></dd>
                                </dl>
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </dd>
        </dl>
    </form>
</section>
@endif
<x-slot name="script">
    <script>
        const dl    =   document.getElementById("dl-menu-link-body");
        let count   =   {{ isset($values["link"]) && count($values["link"]) ? count($values["link"]) : 0 }};
        function up(num){
            const dd            =   document.getElementById("dd-menu-link-body-" + num);
            const previous_dd   =   dd.previousElementSibling;
            previous_dd ? dl.insertBefore(dd, previous_dd) : null;
            order();
        }
        function down(num){
            const dd        =   document.getElementById("dd-menu-link-body-" + num);
            const next_dd   =   dd.nextElementSibling;
            next_dd ? dl.insertBefore(next_dd, dd) : null;
            order();
        }
        function remove(num){
            const dd    =   document.getElementById("dd-menu-link-body-" + num);
            dd.remove();
            order();
        }
        function add(){
            const num       =   count++;
            const sumple    =   document.getElementById("dd-menu-link-body-sumple");
            const dd        =   sumple.cloneNode(sumple);
                dd.removeAttribute("class");
                dd.setAttribute("id", "dd-menu-link-body-" + num);
                dd.querySelectorAll("input").forEach(input => input.setAttribute("name", input.getAttribute("name").replace("num", num)));
                dd.querySelectorAll("textarea").forEach(input => input.setAttribute("name", input.getAttribute("name").replace("num", num)));
                dd.querySelectorAll("button").forEach(button => button.setAttribute("onclick", button.getAttribute("onclick").replace("'num'", num)));
            dl.insertBefore(dd, null);
            order();
        }
        function order(){
            console.log("order");
            dl.querySelectorAll("input[name^='link'][name$='[order]']").forEach((input, index) => input.value  =   index + 1);
        }
    </script>
</x-slot>
</x-website.frame.edit>