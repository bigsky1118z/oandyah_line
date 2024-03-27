<x-admin.api.line.frame.basic :channel="$channel" title="新規メッセージ作成" heading="新規メッセージ作成">
<x-slot name="head">
</x-slot>
<h3>メッセージ作成</h3>
<div id="create-message-objects" class="create-message-objects">
        <form action="/api/line/{{ $channel->channel_name }}/send/create" method="post">
            @csrf
            <div id="create-message-object-messages-options" class="options-messages div-dl-dt-150px">
                <h4>送信条件</h4>
                <x-admin.api.line.form.schedule :channel="$channel" />
                <x-admin.api.line.form.endpoint :channel="$channel" />
                <x-admin.api.line.form.unit :channel="$channel" />
                <x-admin.api.line.form.notification :channel="$channel" />
            </div>
            <div id="create-message-object-messages-type" class="select-messages">
                <h4>メッセージ</h4>
                @foreach (range(0,4) as $number)
                    <dl class="dl-flex-left">
                        <dt>メッセージ{{ $number + 1 }}</dt>
                        <dd>
                            <select id="message-{{ $number + 1 }}-category" class="message-object select-category" data-target="message-{{ $number + 1 }}-select" onchange="selectSearch(this);">
                                <option value="">---</option>
                                @php $category_array =   array(); @endphp
                                @foreach ($messages as $message)
                                    @if(in_array(array($message->category, $message->sub_category), $category_array))
                                        @continue
                                    @else
                                        @php $category_array[]  =   array($message->category, $message->sub_category); @endphp
                                        <option value="{{ $message->category }}" data-category="{{ $message->category }}" data-sub-category="{{ $message->sub_category }}">{{ $message->category }} {{ isset($message->sub_category) ? "($message->sub_category)" : null }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </dd>
                        <dd>
                            <select id="message-{{ $number + 1 }}-select"class="message-object select-message" name="massage[]" @if ($loop->first) required @endif>
                                <option value="">---</option>
                                @foreach ($messages as $message)
                                    <option value="{{ $message->id }}" data-category="{{ $message->category }}" data-sub-category="{{ $message->sub_category }}">{{ $message->name }}</option>
                                @endforeach
                            </select>
                        </dd>
                        <dd>
                            <button id="message-{{ $number + 1 }}-new" class="message-object button-new" type="button" onclick="openModal(this);" data-modal-id="create-message" data-target="message-{{ $number + 1 }}-message">メッセージ作成</button>
                        </dd>
                    </dl>
                @endforeach
            </div>
            <p><input type="submit" value="send"></p>
        </form>
</div>
<x-slot name="modal">
<div id="create-message" class="hidden" style="position: fixed; width:100%; height:100%; top:0; left:0; background-color:rgba(0,0,0,0.5); display:flex; justify-content:center;flex-direction:column;align-items:center;">
    <p style="text-align: center;">
        <select class="select-iframe-path" id="message-type" onchange="setIframeSrc(this, 'create-message-iframe');">
            <option value="">---</option>
            <option value="text">テキスト</option>
            <option value="image">画像</option>
            <option value="location">位置情報</option>
            <option value="template-buttons">ボタン</option>
            <option value="template-confirm">確認</option>
        </select>
    </p>
    <iframe id="create-message-iframe" height="75%" width="90%" frameborder="1" loading="lazy" style="background-color: #FFFFFF"></iframe>

    <p style="text-align: center;"><button type="button" onclick="cancelModal(this);">キャンセル</button></p>
</div>
</x-slot>

<x-slot name="script">
<x-admin.api.line.script.schedule :channel="$channel" />
<script>
    function openModal(button){
        const modalId   =   button.getAttribute("data-modal-id");
        const modal =   document.getElementById(modalId);
        modal.setAttribute("data-target",button.getAttribute("data-target"));
        modal.classList.remove("hidden");
    }

    function cancelModal(button){
        const modal =   button.closest("div");
        modal.classList.add("hidden");
    }

    function setIframeSrc(select, iframeId){
        const type      =   select.value;
        const iframe    =   document.getElementById(iframeId);
        if(type && iframe){
            iframe.setAttribute("src","/api/line/{{ $channel->channel_name }}/message/async/create/"+type);
            iframe.classList.remove("hidden");
        }
        if(!type && iframe){
            iframe.removeAttribute("src");
        }
    }

    function selectSearch(select){
        const target    =   document.getElementById(select.getAttribute("data-target"));
        if(target){
            const selected      =   select.options[select.selectedIndex];
            const category      =   selected.hasAttribute("data-category") ? selected.getAttribute("data-category") : "";
            const subCategory   =   selected.hasAttribute("data-sub-category") ? selected.getAttribute("data-sub-category") : "";
            if(category){
                Array.from(target.children).forEach(node => {
                    if(!node.value){
                        node.classList.remove("hidden");
                    } else if(category == node.getAttribute("data-category") && subCategory == node.getAttribute("data-sub-category")){
                        node.classList.remove("hidden");                        
                    } else {
                        node.classList.add("hidden");
                    }
                });
                const targetSelected    =   target.options[target.selectedIndex];
                const targetCategory    =   targetSelected.hasAttribute("data-category") ? targetSelected.getAttribute("data-category") : "";
                const targetSubCategory =   targetSelected.hasAttribute("data-sub-category") ? targetSelected.getAttribute("data-sub-category") : "";
                if(targetCategory != category || targetSubCategory != subCategory){
                    target.selectedIndex    =   0;
                }
            }else{
                Array.from(target.children).forEach(node => node.classList.remove("hidden"));
            }
        } else {
            console.error("対象が見つかりません");
        }
    }



    function reloadSelect(url){
        fetch("/api/line/{{ $channel->channel_name }}/message/async/list").then(response=>{
            return response.json();
        }).then(data=>{
            const selects   =   document.querySelectorAll("select.message-object");
            selects.forEach(select =>{
                const selected  =   select.options[select.selectedIndex];
                console.log(selected);
                while(select.lastChild){
                    select.removeChild(select.lastChild);
                }
                console.log(selected);
                // const defaultOption =   document.createElement("option");
                // defaultOption.textContent   =   "---";
                // select.appendChild(defaultOption);
                // // if(select.classList.contains("select-category")){
                // //     data    =   data.filter((datum,index,array)=> array.findIndex(arrayDatum => datum.category == arrayDatum.category) == index);
                // // }
                // data.forEach((datum,index,array)=>{
                //     const option    =   document.createElement("option");
                //     if(select.classList.contains("select-category")){
                //         if(array.findIndex(arrayDatum => arrayDatum.category == datum.category) == index){
                //             option.setAttribute("value",datum.category);
                //             option.textContent  =   datum.category;
                //         } else {
                //             return false;
                //         }
                //     }
                //     if(select.classList.contains("select-message")){
                //         option.setAttribute("value",datum.id);
                //         option.textContent  =   datum.name;
                //     }
                //     if(select.value == option.value){
                //         option.selected =   true;
                //     }
                //     select.appendChild(option);
                // });
                // select.onchange();
            });
        });
    }

</script>

</x-slot>

</x-admin.api.line.frame.basic>