<x-admin.api.line.frame.basic>
<x-slot name="head">
<style>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #fff;
        width: 400px;
        max-height: 500px;
        overflow-y: auto;
        margin: 100px auto 50px auto;
        padding: 20px;
    }

</style>
</x-slot>
<table>
    <tbody>
        <tr>
            <th>上限</th>
            <td>{{ $quota['value'] }}</td>
        </tr>
        <tr>
            <th>今月の送信件数</th>
            <td>{{ $quota_consumption['totalUsage'] }}</td>
        </tr>
    </tbody>
</table>
<form action="/api/line/{{ $channel_name }}/send_form" method="post">
    <table>
        <tbody>
            <tr>
                <th>送信方法</th>
                <td colspan="2">
                    <select name="endpoint_name" required onchange="selectEndpoint(this);">
                        <option value="">---</option>
                        <option value="push">送信相手を指定する</option>
                        {{-- <option value="narrowcast">送信条件を指定する</option> --}}
                        <option value="broadcast">全員に送信する</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>オプション</th>
                <td></td>
            </tr>
            <tr>
                <th>非通知送信</th>
                <td><input type="checkbox" name="notificationDisabled" value="true"></td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>select</th>
                <th>content</th>
            </tr>
        </thead>
        <tbody>
            @foreach (range(1,5) as $number)
            <tr>
                <td>
                    <select name="messages[{{ $number }}][type]" onchange="selectType(this);" @if ($loop->first) required @endif>
                        <option value="">---</option>
                        <option value="text">text</option>
                        {{-- <option value="sticker">sticker</option> --}}
                        <option value="image">image</option>
                        {{-- <option value="video">video</option> --}}
                        {{-- <option value="audio">audio</option> --}}
                        <option value="location">location</option>
                        {{-- <option value="imagemap">imagemap</option> --}}
                        <option value="template_buttons">buttons</option>
                        <option value="template_confirm">confirm</option>
                        <option value="template_carousel">carousel</option>
                        <option value="template_image_carousel">image_carousel</option>
                        {{-- <option value="flex_bubble">bubble</option> --}}
                    </select>
                </td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><input type="submit" value="send"></p>
</form>
<x-slot name="hidden">
    <x-admin.api.parts.send.endpoint-push id="sumple_endpoint_push" />
    {{-- <x-admin.api.parts.send.endpoint-narrowcast id="sumple_endpoint_narrowcast" /> --}}
    <x-admin.api.parts.send.endpoint-userlist name="to[]" :users="$users"/>
    <x-admin.api.parts.input.input id="sumple_unit" name="custom_aggregation_unit[]" />
    

    <x-admin.api.parts.send.message-text id="sumple_type_text" />
    <x-admin.api.parts.send.message-image id="sumple_type_image" />
    <x-admin.api.parts.send.message-location id="sumple_type_location" />

    <x-admin.api.parts.send.message-template-buttons id="sumple_type_template_buttons" onchange="selectAction(this);" />
    <x-admin.api.parts.send.message-template-confirm id="sumple_type_template_confirm" onchange="selectAction(this);" />
    <x-admin.api.parts.send.message-template-carousel id="sumple_type_template_carousel" onchange="selectAction(this);" />
    <x-admin.api.parts.send.message-template-image-carousel id="sumple_type_template_image_carousel" onchange="selectAction(this);" />

    <x-admin.api.parts.send.action-postback id="sumple_action_postback" />
    <x-admin.api.parts.send.action-message id="sumple_action_message" />
    <x-admin.api.parts.send.action-uri id="sumple_action_uri" />
    <x-admin.api.parts.send.action-datetimepicker-date id="sumple_action_datetimepicker_date" />
    <x-admin.api.parts.send.action-datetimepicker-time id="sumple_action_datetimepicker_time" />
    <x-admin.api.parts.send.action-datetimepicker-datetime id="sumple_action_datetimepicker_datetime" />
</x-slot>

<x-slot name="modal">
    <x-admin.api.parts.modal.send-endpoint-push-to id="modal_to" :users="$users" onchange="selectModalUser(this);" />
    {{-- <x-admin.api.parts.modal.send-endpoint-narrowcast-recipient id="modal_recipient" onchange="selectModalUser(this);" />
    <x-admin.api.parts.modal.send-endpoint-narrowcast-filter id="modal_filter" onchange="selectModalUser(this);" />
    <x-admin.api.parts.modal.send-endpoint-narrowcast-limit id="modal_limit" onchange="selectModalUser(this);" /> --}}
</x-slot>

<x-slot name="script">
    <script>
        /** endpoint */
        function selectEndpoint(param){
            const value         =   param.value;
            const endpoint_tr   =   param.closest("tr");
            const option_tr     =   endpoint_tr.nextElementSibling;
            const option_td     =   option_tr.querySelector("td");
            while(option_td.lastChild){
                option_td.removeChild(option_td.lastChild);
            }
            const sumple    =   document.getElementById(`sumple_endpoint_${value}`);
            if(sumple){
                const table =   sumple.cloneNode(true);
                table.removeAttribute("id");
                option_td.appendChild(table);
            }
        }

        function openModal(id) {
            const modal =   document.getElementById(id);
            if(modal){
                modal.style.display =   "block";
            }
        }

        function selectModalUser(param){
            const value =   param.value;
            const ul    =   document.querySelector("ul#to");
            if(param.checked){
                console.log("check");
                const user  =   document.getElementById(`user_id_${value}`).cloneNode(true);
                user.id     =   `selected_user_id_${value}`;
                const li    =   document.createElement("li");
                li.appendChild(user);
                ul.appendChild(li);
            }
            if(!param.checked){
                console.log("uncheck");
                const user  =   document.getElementById(`selected_user_id_${value}`);
                user.closest("li").remove();
            }
        }

        function closeModal(param) {
            const modal =   param.closest("div");
            if(modal){
                modal.style.display =   "none";
            }
        }



        /** message object */
        function selectType (param) {
            const value             =   param.value;
            const name              =   param.name;
            const selectTd          =   param.closest('td');
            const contentTd         =   selectTd.nextElementSibling;
            while(contentTd.lastChild){
                contentTd.removeChild(contentTd.lastChild);
            }
            if(value){
                const content   =   document.getElementById(`sumple_type_${value}`).cloneNode(true);
                content.removeAttribute('id');
                Array.from(content.querySelectorAll("td>input, td>textarea, td>select")).forEach(node => {
                    let nodeName    =   node.name;
                    if(node.name.includes("[")){
                        nodeName    = node.name.replace(/\]/g,"").split("[").join("][");
                    }
                    node.setAttribute('name', name.replace("[type]", `[${nodeName}]`));
                });
                contentTd.appendChild(content);
            }
        }

        function selectAction (param) {
            const value     =   param.value;
            const name      =   param.name;
            const selectTd  =   param.closest('td');
            const actionTd  =   selectTd.nextElementSibling;
            while(actionTd.lastChild){
                actionTd.removeChild(actionTd.lastChild);
            }
            if(value){
                const action   =   document.getElementById(`sumple_action_${value}`).cloneNode(true);
                action.removeAttribute('id');
                Array.from(action.querySelectorAll("td>input, td>textarea, td>select")).forEach(node => {
                    node.setAttribute('name', name.replace("type", node.name));
                });
                actionTd.appendChild(action);
            }
        }

        function addColumn(param) {
            const table     =   param.closest("table");
            const thead_tr  =   table.querySelector("thead>tr");

            if(thead_tr.childElementCount<10+1){
                const th    =   document.createElement("th");
                th.setAttribute("colspan",2);
                thead_tr.insertAdjacentElement("beforeend",th);
            }
            
            /* tbody */
            const button_td =   param.closest("td");
            Array.from(table.querySelector("tbody").children).forEach((tr,tr_index)=>{
                const td    =   document.createElement("td");
                const input =   tr.querySelector("td>input, td>textarea, td>select");
                if(input){
                    const clone_input   =   input.cloneNode(true);
                    if(!clone_input.type=="color"){
                        clone_input.value   =   null;
                    }
                    if(clone_input.type=="color"){
                        clone_input.value   =   "#FFFFFF";
                    }
                    td.appendChild(clone_input);
                }
                switch(tr_index){
                    case 0:
                        td.setAttribute("colspan","2");
                        tr.insertBefore(td, button_td);
                        break;
                    case 1: case 6: case 7:
                        td.setAttribute("colspan","2");
                        tr.insertAdjacentElement("beforeend",td);
                        break;
                    case 2: case 3: case 4: case 5:
                        tr.insertAdjacentElement("beforeend",td);
                        tr.insertAdjacentElement("beforeend",document.createElement("td"));
                        break;                    
                }
            });

            const tfoot_tr  =   table.querySelector("tfoot>tr");

            if(tfoot_tr.childElementCount<10+1){
                const td            =   document.createElement("td");
                td.setAttribute("colspan","2");
                const button        =   document.createElement("button");
                button.textContent  =   "－";
                button.setAttribute("type", "button");
                button.setAttribute("onclick", "removeColumn(this);");
                td.appendChild(button);
                tfoot_tr.insertAdjacentElement("beforeend",td);
            }
            renameColumn(table);

            if(Array.from(param.closest("tr").children).indexOf(button_td)>=10+1){
                button_td.remove();
            }

        }

        function removeColumn (param){
            const button_td     =   param.closest("td");
            const table         =   param.closest("table");
            const tfoot_tr      =   table.querySelector("tfoot>tr");
            const tfoot_index   =   Array.from(tfoot_tr.children).indexOf(button_td);

            table.querySelector("thead>tr").children[tfoot_index].remove();
            Array.from(table.querySelector("tbody").children).forEach((tr, tr_index)=>{
                switch(tr_index){
                    case 0: case 1: case 6: case 7:
                        tr.children[tfoot_index+1].remove();
                        break;
                    case 2: case 3: case 4: case 5:
                        tr.children[(tfoot_index*2)].remove();
                        tr.children[(tfoot_index*2)].remove();
                        break;
                }
            });
            table.querySelector("tfoot>tr").children[tfoot_index].remove();
            
            renameColumn(table);

            const tbody_tr  =   table.querySelector("tbody>tr");
            if(!tbody_tr.lastElementChild.querySelector("button")){
                const td            =   document.createElement("td");
                td.setAttribute("colspan","2");
                td.setAttribute("rowspan","8");
                const button        =   document.createElement("button");
                button.textContent  =   "＋";
                button.setAttribute("type", "button");
                button.setAttribute("onclick", "addColumn(this);");
                td.appendChild(button);
                tbody_tr.insertAdjacentElement("beforeend",td);
            }
            return;
        }

        function renameColumn(table) {
            table   =   table.closest("table");
            table.querySelector("thead").querySelectorAll("tr>th").forEach((th, th_index)=>{
                if(th_index>0){
                    th.textContent  =   th_index;
                }
            });
            Array.from(table.querySelector("tbody").children).forEach((tr,tr_index)=>{
                Array.from(tr.children).forEach((td, td_index)=>{
                    switch(tr_index){
                        case 0: case 1: case 6: case 7:
                            td_index    =   td_index-1;
                            break;
                        case 2: case 3: case 4: case 5:
                            td_index    =   Math.floor(td_index/2);
                            break;
                    }
                    console.log(tr_index, td_index);
                    td.querySelectorAll("input, textarea, select").forEach(node=>{
                        node.setAttribute("name",node.name.replace(/\[columns\]\[\d+\]/,`[columns][${td_index}]`));
                    });
                });
            });
        }

        function removeRow(param) {
            const table     =   param.closest("table");
            const button_th =   param.closest("th");
            const button_tr =   param.closest("tr");
            Array.from(button_tr.children).forEach((td, td_index)=>{
                if(td_index>0){
                    while(td.lastChild){
                        td.removeChild(td.lastChild);
                    }
                }
            });
            const button    =   document.createElement("button");
            button.setAttribute("type", "button");
            button.setAttribute("onclick", "addRow(this);");
            button.textContent  =   "＋";
            button_th.insertAdjacentElement("beforeend",button);
            renameColumn(table);
        }

        function addRow(param) {
            const table         =   param.closest("table");
            const button_th     =   param.closest("th");
            const button_tr     =   param.closest("tr");
            const tbody         =   param.closest("tbody");
            const tr_index      =   Array.from(tbody.children).indexOf(button_tr);
            const input         =   tbody.querySelector("tr>td>input").cloneNode(true);
            const template_name =   input.name;
            input.value         =   null;
            const select        =   tbody.querySelector("tr>td>select").cloneNode(true);
            select.value        =   null;
            switch(tr_index){
                case 1:
                    input.setAttribute("name",template_name.replace("text","title"));
                    break;
                case 2:
                    select.setAttribute("name",template_name.replace("text","defaultAction][type"));
                    break;
                case 4:
                    select.setAttribute("name",template_name.replace("text","actions][2][type"));
                    break;
                case 5:
                    select.setAttribute("name",template_name.replace("text","actions][3][type"));
                    break;
                case 6:
                    input.setAttribute("name",template_name.replace("text","thumbnailImageUrl"));
                    break;
                case 7:
                    input.setAttribute("type","color");                
                    input.setAttribute("name",template_name.replace("text","imageBackgroundColor"));
                    break;
            }
            Array.from(button_tr.children).forEach((td, td_index)=>{
                if(td_index>0){
                    while(td.lastChild){
                        td.removeChild(td.lastChild);
                    }
                }
                switch(tr_index){
                    case 1: case 6: case 7:
                        if(td_index>1){
                            td.appendChild(input.cloneNode(true));
                        }
                        break;
                    case 2: case 4: case 5:
                        if(td_index>1 && td_index%2==0){
                            td.appendChild(select.cloneNode(true));
                        }
                        break;
                }
            });
            const button    =   document.createElement("button");
            button.setAttribute("type", "button");
            button.setAttribute("onclick", "removeRow(this);");
            button.textContent  =   "－";
            button_th.insertAdjacentElement("beforeend",button);
            renameColumn(table);
        }


    </script>
</x-slot>

</x-admin.api.line.frame.basic>