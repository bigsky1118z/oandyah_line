<x-admin.website.frame.basic title="Menu Setting" heading="メニュー編集">
@php
    if ($errors->any()) {
        $values =  array(
            'id'                =>  old('id'),
            'menu_name'         =>  old('menu_name'),
            'menu_title'        =>  old('menu_title'),
            'menus'             =>  old('menus'),
        );
    } elseif (isset($menus)){
        $values =  array(
            'id'                =>  $id,
            'menu_name'         =>  $menu_name,
            'menu_title'        =>  $menu_title,
            'menus'             =>  array(),
        );
        foreach($menus as $menu){
            if($menu->page_item){
                $values['menus'][$menu->index]   = array(
                    'parent'    =>  $menu->page_item->parent,
                    'name'      =>  $menu->page_item->name,
                    'title'     =>  $menu->title,
                );
            }else {
                $values['menus'][$menu->index]   = array(
                    'parent'    =>  "extension",
                    'href'      =>  $menu->href,
                    'title'     =>  $menu->title,
                );
            }
        }
    } elseif (!isset($menus)) {
        $values = array(
            'id'                =>  null,
            'menu_name'         =>  null,
            'menu_title'        =>  null,
            'menus'             =>  array(),
        );
    }
@endphp
@if ($resource == 'create')
    <h3>メニュー作成</h3>
    <form action="/admin/website/menu" method="post">
@elseif($resource == 'edit')
    <h3>メニュー編集</h3>
    <form action="/admin/website/menu/{{ $id }}" method="post">
    @method('put')
@endif
    @csrf

    <table>
        <tbody>
            <tr>
                <th>メニュー名</th>
                <td><input type="text" name="menu_title"  value="{{ $values['menu_title'] }}"></td>
            </tr>
            <tr>
                <th>メニューID</th>
                <td><input type="text" name="menu_name" value="{{ $values['menu_name'] }}"></td>
            </tr>
        </tbody>
    </table>
    
    <table id="menu">
        <thead>
            <tr>
                <th></th>
                <th>parent</th>
                <th>name</th>
                <th>href</th>
                <th>title</th>
                <th colspan="3">button</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($values['menus'] as $index => $menu)
            <tr>
                <td><span>{{ $index }}</span></td>
                    <td><x-admin.website.parts.select.page-parent name="menus[{{ $index }}][parent]" :value="$menu['parent']" onchange="selectedParent(this);" isMenu="true" /></td>
                @if ($menu['parent']=="extension")
                    <td></td>
                    <td><input type="text" name="menus[{{ $index }}][href]" value="{{ $menu['href'] }}" placeholder="href"></td>
                    <td><input type="text" name="menus[{{ $index }}][title]" value="{{ $menu['title'] }}" placeholder="title"></td>
                @else
                    <td><x-admin.website.parts.select.page-name name="menus[{{ $index }}][name]" :parent="$menu['parent']" :value="$menu['name']" onchange="selectedName(this);" /></td>
                    <td><input type="text" name="menus[{{ $index }}][href]" value="{{ $menu['name'] }}" readonly="readonly"></td>
                    <td><input type="text" name="menus[{{ $index }}][title]" value="{{ $menu['title'] }}" placeholder="任意"></td>
                @endif
                <td><button type="button" onclick="buttonThreadUp(this);rename();">↑</button></td>
                <td><button type="button" onclick="buttonThreadDown(this);rename();">↓</button></td>
                <td><button type="button" onclick="buttonThreadDelete(this);rename();">×</button></td>                                
            </tr>
            @endforeach
            @if ($resource== "create" && !$errors->any())
                <tr>
                    <td><span>1</span></td>
                    <td><x-admin.website.parts.select.page-parent name="menus[1][parent]" onchange="selectedParent(this);" /></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button type="button" onclick="buttonThreadUp(this);rename();">↑</button></td>
                    <td><button type="button" onclick="buttonThreadDown(this);rename();">↓</button></td>
                    <td><button type="button" onclick="buttonThreadDelete(this);rename();">×</button></td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"><button type="button" onclick="addNewMenuItem(this)">add new menu item</button></td>
            </tr>
        </tfoot>
    </table>
    <p><input type="submit" onclick="window.onbeforeunload=null;" value="{{ $resource }}"></p>
</form>
@if ($resource == 'edit')
    <h3>delete</h3>
    <form action="/admin/website/menu/{{ $id }}" method="post">
        @method('delete')
        @csrf
        <input type="submit" value="delete">
    </form>               
@endif
<x-slot name="hidden">
    <x-admin.website.parts.select.page-parent id="sumple-parent" isMenu="true"/>
    @foreach ($page_parents as $parent => $items)
    <x-admin.website.parts.select.page-name     :parent="$parent"   id="sumple-{{ $parent }}" />
    @endforeach
    <x-admin.website.parts.select.tool-number id="sumple-number" />
    <x-admin.website.parts.input.input type="text" id="sumple-href" placeholder="nameを選択" readonly="readonly" />
    <x-admin.website.parts.input.input type="text" id="sumple-title" placeholder="任意" />
    <x-admin.website.parts.input.input type="text" id="sumple-href-extension" placeholder="href" required="required" />
    <x-admin.website.parts.input.input type="text" id="sumple-title-extension" placeholder="title" required="required" />
</x-slot>
<x-slot name="script">
    <x-.admin.website.parts.script.button />
    <x-.admin.website.parts.script.onbeforeunload />
        <script>
        function addNewMenuItem(param){
            const tbody = param.closest('table').querySelector('tbody');
            const num   = tbody.children.length+1;
            const tr    = document.createElement('tr');
            const items = new Array();
            items.push(document.createElement('span'));
            const parents   = document.getElementById(`sumple-parent`).cloneNode(true);
            parents.removeAttribute('id');
            parents.setAttribute('onchange', 'selectedParent(this);');
            items.push(parents,null,null,null);
            const buttons  = [
                ['↑','buttonThreadUp'],
                ['↓','buttonThreadDown'],
                ['×','buttonThreadDelete'],
            ];
            buttons.forEach(values=>{
                const button = document.createElement('button');
                button.type = "button";
                button.textContent = values[0];
                button.setAttribute('onclick',`${values[1]}(this);rename();`);
                items.push(button);
            });
            items.forEach(item => {
                const td = document.createElement('td');
                if(item){
                    td.appendChild(item);
                }
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
            rename();
        }
    
        function selectedParent(param) {
            const value     = param.value;
            const parentTd  = param.closest('td');
            const nameTd    = parentTd.nextElementSibling;
            while(nameTd.lastChild){
                nameTd.removeChild(nameTd.lastChild);
            }
            const hrefTd    = nameTd.nextElementSibling;
            while(hrefTd.lastChild){
                hrefTd.removeChild(hrefTd.lastChild);
            }
            const titleTd    = hrefTd.nextElementSibling;
            while(titleTd.lastChild){
                titleTd.removeChild(titleTd.lastChild);
            }
            if(value == "extension"){
                const href = document.getElementById('sumple-href-extension').cloneNode(true);
                href.removeAttribute('id');
                href.removeAttribute('value');
                hrefTd.appendChild(href);
                const title = document.getElementById('sumple-title-extension').cloneNode(true);    
                title.removeAttribute('id');
                title.removeAttribute('value');
                titleTd.appendChild(title);
            }
            if(value != "extension"){
                const names = document.getElementById(`sumple-${value}`).cloneNode(true);
                names.removeAttribute('id');
                names.setAttribute('onchange', 'selectedName(this);');
                nameTd.appendChild(names);

                const href = document.getElementById('sumple-href').cloneNode(true);
                href.removeAttribute('id');
                href.removeAttribute('value');
                hrefTd.appendChild(href);
                const title = document.getElementById('sumple-title').cloneNode(true);    
                title.removeAttribute('id');
                title.removeAttribute('value');
                titleTd.appendChild(title);
            }
            rename();
        }

        function selectedName(param) {
            const value     = param.value;
            const nameTd    = param.closest('td');
            const hrefTd    = nameTd.nextElementSibling;
            while(hrefTd.lastChild){
                hrefTd.removeChild(hrefTd.lastChild);
            }
            const href = document.getElementById('sumple-href').cloneNode(true);
            if(value){
                href.setAttribute('value',value);
            }
            hrefTd.appendChild(href);
            rename();
        }

        function rename(){
            const trs = document.querySelector('table#menu').querySelector('tbody').querySelectorAll('tr');
            Array.from(trs).forEach((tr,trIndex)=>Array.from(tr.children).forEach((td,tdIndex)=>{
                switch(tdIndex){
                    case 0 :
                        if(td.querySelector('span')){
                            td.querySelector('span').textContent = Number(trIndex+1);
                        }
                        break;
                    case 1 :
                        if(td.querySelector('select')){
                            td.querySelector('select').name = `menus[${Number(trIndex+1)}][parent]`;
                        }
                        break;
                    case 2 :
                        if(td.querySelector('select')){
                            td.querySelector('select').name = `menus[${Number(trIndex+1)}][name]`;
                        }
                        break;
                    case 3 :
                        if(td.querySelector('input')){
                            td.querySelector('input').name = `menus[${Number(trIndex+1)}][href]`;
                        }
                        break;
                    case 4 :
                        if(td.querySelector('input')){
                            td.querySelector('input').name = `menus[${Number(trIndex+1)}][title]`;
                        }
                        break;
                }
            }));
        }
        rename();
    </script>
</x-slot>
</x-admin.website.frame.basic>