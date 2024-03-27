<x-admin.website.frame.basic title="Header - Setting" heading="ヘッダー編集">
    <x-slot name="head">
    </x-slot>
    <form action="/admin/website/header" method="POST">
        @csrf
        <table id="header">
            <thead>
                <tr>
                    <th></th>
                    <th>parent</th>
                    <th>name</th>
                    <th>option</th>
                    <th colspan="3">button</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($headers as $index=>$item)
                <tr>
                    <td><span>{{ $item->index }}</span></td>
                    <td><x-admin.website.parts.select.page-parent   name="headers[{{ $item->index }}][parent]"  :value="$item->page->parent"    onchange="selectedParent(this);" /></td>
                    <td><x-admin.website.parts.select.page-name     name="headers[{{ $item->index }}][name]"    :parent="$item->page->parent"   :value="$item->page->name" /></td>
                    <td><x-admin.website.parts.select.header-option name="headers[{{ $item->index }}][option]"  :parent="$item->page->parent"   :value="$item->page->option" /></td>
                    <td><button type="button" onclick="buttonThreadUp(this);rename();">↑</button></td>
                    <td><button type="button" onclick="buttonThreadDown(this);rename();">↓</button></td>
                    <td><button type="button" onclick="buttonThreadDelete(this);rename();">×</button></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7"><button type="button" onclick="addNewPage(this);">add new page</button></td>
                </tr>
            </tfoot>
        </table>
        <p><button type="submit" onclick="window.onbeforeunload=null;">save</button></p>
    </form>
    <x-slot name="hidden">
        <x-admin.website.parts.select.page-parent id="sumple-parent" />
        @foreach ($page_parents as $parent => $title)
            <x-admin.website.parts.select.page-name     :parent="$parent"  id="sumple-{{ $parent }}" />
            <x-admin.website.parts.select.header-option :parent="$parent"  id="sumple-option-{{ $parent }}" />
        @endforeach
        <x-admin.website.parts.select.tool-number   id="sumple-number" />
    </x-slot>
    <x-slot name="script">
        <x-.admin.website.parts.script.button />
        <x-.admin.website.parts.script.onbeforeunload />
        <script>
            function addNewPage(param){
                const tbody = param.closest('table').querySelector('tbody');
                const num       = tbody.children.length+1;
                const tr        = document.createElement('tr');
                const items     = new Array();
                items.push(document.createElement('span'));
                const parents   = document.getElementById(`sumple-parent`).cloneNode(true);
                parents.removeAttribute('id');
                parents.setAttribute('onchange', 'selectedParent(this);');
                items.push(parents, null, null);
                ['buttonThreadUp','buttonThreadDown','buttonThreadDelete'].forEach(buttonName=>{
                    const button    =   document.getElementById(buttonName).cloneNode(true);
                    button.removeAttribute('id');
                    const onclick   =   button.getAttribute('onclick');
                    button.setAttribute('onclick',`${onclick} rename();`);
                    items.push(button);
                });
                items.forEach(el => {
                    const td = document.createElement('td');
                    if(el){
                        td.appendChild(el);
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
                const names     = document.getElementById(`sumple-${value}`).cloneNode(true);
                names.removeAttribute('id');
                while(nameTd.lastChild){
                    nameTd.removeChild(nameTd.lastChild);
                }
                nameTd.appendChild(names);
                const optionTd  = nameTd.nextElementSibling;
                const options   = document.getElementById(`sumple-option-${value}`).cloneNode(true);
                options.removeAttribute('id');
                while(optionTd.lastChild){
                    optionTd.removeChild(optionTd.lastChild);
                }
                optionTd.appendChild(options);
                rename();
            }
            
            function rename(){
                const trs = document.querySelector('table#header').querySelector('tbody').querySelectorAll('tr');
                Array.from(trs).forEach((tr,trIndex)=>Array.from(tr.children).forEach((td,tdIndex)=>{
                    switch(tdIndex){
                        case 0 :
                            if(td.querySelector('span')){
                                td.querySelector('span').textContent = Number(trIndex+1);
                            }
                            break;
                        case 1 :
                            if(td.querySelector('select')){
                                td.querySelector('select').name = `headers[${Number(trIndex+1)}][parent]`;
                            }
                            break;
                        case 2 :
                            if(td.querySelector('select')){
                                td.querySelector('select').name = `headers[${Number(trIndex+1)}][name]`;
                            }
                            break;
                        case 3 :
                            if(td.querySelector('select')){
                                td.querySelector('select').name = `headers[${Number(trIndex+1)}][option]`;
                            }
                            break;
                    }
                }));
            }
            rename();

        </script>
    </x-slot>
</x-admin.website.frame.basic>