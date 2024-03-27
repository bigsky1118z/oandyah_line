@php
if(isset($_POST["post"])){
    echo "<script>alert('保存しました')</script>";
    exit;
}
@endphp
<x-line.frame.iframe>
    <x-slot name="id">line-iframe-message</x-slot>
    {{-- <x-slot name="head"></x-slot> --}}
    {{-- <x-slot name="header"></x-slot> --}}
    <section id="create">
        <h3>新規メッセージ作成</h3>
        <form id="form-message-create">
            @csrf
            <dl id="dl-line-message-iframe-message-create">
                <dt id="dt-line-message-iframe-message-create-header">
                </dt>
                <dd id="dd-line-message-iframe-message-create-body">
                    <dl id="dl-line-message-iframe-message-create-type" class="dl-line-message-iframe-message-create-group">
                        <dt class="dt-line-message-iframe-message-create-title">名前</dt>
                        <dd class="dd-line-message-iframe-message-create-value">
                            <input type="text" name="name">
                        </dd>
                    </dl>
                    <dl id="dl-line-message-iframe-message-create-type" class="dl-line-message-iframe-message-create-group">
                        <dt class="dt-line-message-iframe-message-create-title">種類</dt>
                        <dd class="dd-line-message-iframe-message-create-value">
                            <select name="type" onchange="select_type();" required>
                                <option value="text">テキスト</option>
                                <option value="image">画像</option>
                                <option value="template">ボタン</option>
                            </select>
                        </dd>
                    </dl>
                    <dl id="dl-line-message-iframe-message-create-text" class="dl-line-message-iframe-message-create-group">
                        <dt class="dt-line-message-iframe-message-create-title">テキスト</dt>
                        <dd class="dd-line-message-iframe-message-create-value">
                            <textarea name="text"></textarea>
                        </dd>
                    </dl>
                    <dl id="dl-line-message-iframe-message-create-image" class="dl-line-message-iframe-message-create-group">
                        <dt class="dt-line-message-iframe-message-create-title">画像</dt>
                        <dd class="dd-line-message-iframe-message-create-value">
                            <input  type="file" name="image" accept="image/*">
                        </dd>
                    </dl>
                </dd>
                <dd id="dd-line-message-iframe-message-create-footer">
                    <dl class="dl-line-message-iframe-message-create-group">
                        <dd class="dd-line-message-iframe-message-create-button">
                            <button type="button" onclick="set_message_object();">作成</button>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </form>
    </section>
    <section id="select">
        @php
            $selected   =   isset($message,$query["index"]) ? $message->message_objects($query["index"])->first() : null;
        @endphp
        <h3>既成メッセージ選択</h3>
        <dl id="dl-line-message-iframe-message-select">
            <dt id="dt-line-message-iframe-message-select-header">
                <form id="form-message-select-query" onchange="get_message_objects();">
                    @csrf
                    <dl class="dl-line-message-iframe-message-select-group">
                        <dd class="dd-line-message-iframe-message-select-query">
                            <select name="message_object[type]">
                                <option value="">---</option>
                                <option value="text" @selected($selected && $selected->type == "text")>text</option>
                                <option value="sticker" @selected($selected && $selected->type == "sticker")>sticker</option>
                                <option value="image" @selected($selected && $selected->type == "image")>image</option>
                                <option value="video" @selected($selected && $selected->type == "video")>video</option>
                                <option value="audio" @selected($selected && $selected->type == "audio")>audio</option>
                                <option value="location" @selected($selected && $selected->type == "location")>location</option>
                                <option value="imagemap" @selected($selected && $selected->type == "imagemap")>imagemap</option>
                                <option value="template" @selected($selected && $selected->type == "template")>template</option>
                                <option value="flex" @selected($selected && $selected->type == "flex")>flex</option>
                            </select>
                            <select name="query_status">
                                <option value="">all</option>
                                <option value="auto">自動返信</option>
                                <option value="draft">下書き</option>
                                <option value="sent">送信済</option>
                            </select>
                        </dd>
                    </dl>
                </form>
            </dt>
            <dd id="dd-line-message-iframe-message-select-body">
                <p><button type="button" onclick="message_object_unselected();">選択解除</button></p>
                <form id="form-message-select-result">
                    @if ($selected)
                        @foreach ($line->message_objects($selected->type)->get() as $message_object)
                            <dl id="dl-line-message-iframe-message-select-{{ $message_object->id }}" class="dl-line-message-iframe-message-select-group{{ $selected->line_message_type_id == $message_object->id ? " dl-line-message-iframe-message-select-group-selected" : null }}">
                                <dt class="dt-line-message-iframe-message-select-radio hidden">
                                    <input type="radio" id="message_{{ $message_object->id }}" name="message_object[id]" data-name="{{ $message_object->name }}" value="{{ $message_object->id }}" onchange="message_object_is_selected();" @checked($selected->line_message_type_id == $message_object->id)>
                                </dt>
                                <dd class="dd-line-message-iframe-message-select-name">
                                    <label for="message_{{ $message_object->id }}">{{ $message_object->name }}</label>
                                </dd>
                                <dd class="dd-line-message-iframe-message-select-value">
                                    <label for="message_{{ $message_object->id }}">{!! $message_object->get_html() !!}</label>
                                </dd>
                                <dd class="dd-line-message-iframe-message-select-button">
                                    <button type="button" class="button-line-message-iframe-messeage-select-button-edit" onclick="edit_message_object(this);">編集</button>
                                    <button type="button" class="button-line-message-iframe-messeage-select-button-delete">削除</button>
                                    <button type="button" class="button-line-message-iframe-messeage-select-button-reference">参照</button>
                                </dd>
                            </dl>
                        @endforeach
                    @endif
                </form>
            </dd>
            <dd id="dd-line-message-iframe-message-footer">
                <dl id="dl-line-message-iframe-message-select-sumple" class="dl-line-message-iframe-message-select-group">
                    <dt class="dt-line-message-iframe-message-select-radio hidden">
                        <input type="radio" name="message_object[id]" onchange="message_object_is_selected();">
                    </dt>
                    <dd class="dd-line-message-iframe-message-select-name">
                        <label></label>
                    </dd>
                    <dd class="dd-line-message-iframe-message-select-value">
                        <label></label>
                    </dd>
                    <dd class="dd-line-message-iframe-message-select-button">
                        <button type="button" class="button-line-message-iframe-messeage-select-button-edit" onclick="edit_message_object(this);">編集</button>
                        <button type="button" class="button-line-message-iframe-messeage-select-button-delete">削除</button>
                        <button type="button" class="button-line-message-iframe-messeage-select-button-reference">参照</button>
                    </dd>
                </dl>
            </dt>
        </dl>
    </section>
    {{-- <x-slot name="footer"></x-slot> --}}
    {{-- <x-slot name="hidden"></x-slot> --}}
    <x-slot name="script">
        <script>
            select_type();
            function select_type(){
                const select    =   document.querySelector("select[name=type]");
                if(select){
                    const value     =   select.value;
                    const text      =   document.getElementById("dl-line-message-iframe-message-create-text");
                    const image     =   document.getElementById("dl-line-message-iframe-message-create-image");
                    switch(value){
                        case("text"):
                            [text].forEach(dl => dl.classList.remove("hidden"));
                            [image].forEach(dl => dl.classList.add("hidden"));
                            break;
                        case("image"):
                            [image].forEach(dl => dl.classList.remove("hidden"));
                            [text].forEach(dl => dl.classList.add("hidden"));
                            break;
                    }
                }
            }

            function message_object_unselected(){
                const dd    =   document.getElementById("dd-line-message-iframe-message-select-body");
                dd.querySelectorAll("dl.dl-line-message-iframe-message-select-group").forEach(dl => {
                    const class_name    =   "dl-line-message-iframe-message-select-group-selected";
                    const radio         =   dl.querySelector("input[type='radio']");
                    radio.checked       =   false;
                    dl.classList.remove(class_name);
                });
            }

            function message_object_is_selected(){
                const dd    =   document.getElementById("dd-line-message-iframe-message-select-body");
                dd.querySelectorAll("dl.dl-line-message-iframe-message-select-group").forEach(dl => {
                    const class_name    =   "dl-line-message-iframe-message-select-group-selected";
                    const radio         =   dl.querySelector("input[type='radio']");
                    radio.checked       ? dl.classList.add(class_name)  : dl.classList.remove(class_name);
                });
            }

            function select_all(boolean){
                const class_name    =   "dl-line-message-iframe-message-checked";
                const dd            =   document.getElementById("dd-line-message-iframe-message-body");
                dd.querySelectorAll("dl.dl-line-message-iframe-message-value").forEach(dl => {
                    boolean ? dl.classList.add(class_name)  : dl.classList.remove(class_name);
                    dl.querySelector("dt.dt-line-message-iframe-message-checkbox > input[type=checkbox]").checked = boolean;
                });
            }

            async function set_message_object(){
                const form  =   document.getElementById("form-message-create");
                if(form){
                    const id        = form.getAttribute("data-id");
                    const response  = await fetch(`/line/{{ $line->name }}/message/iframe/message${id ? "/".id : null}`, {
                        "method"    : "post",
                        "body"      : new FormData(form),
                    });
                    form.querySelectorAll("input, textarea").forEach(input => {
                        input.value = "";
                        input.checked = false;
                    });
                    form.querySelectorAll("select").forEach(select => {
                        select.selectedIndex = 0;
                    });
                    if(response.ok){
                        const result        =   await response.json();
                        const query_form    =   document.getElementById("form-message-select-query");
                        const query_type    =   query_form.querySelector("select[name='message_object[type]']");
                        query_type.value    =   result["type"]  ??  null;
                        get_message_objects();
                    } else {
                    }

                }
            }
            async function get_message_objects(){
                const form  =   document.getElementById("form-message-select-query");
                if(form){
                    const response  = await fetch("/line/{{ $line->name }}/message/iframe/message/object", {
                        "method"    : "post",
                        "body"      : new FormData(form),
                    });
                    if(response.ok){
                        const result    =   await response.json();
                        const body_form =   document.querySelector("dd#dd-line-message-iframe-message-select-body > form");
                        Array.from(body_form.children).forEach(node => node.remove());
                        if(result["objects"] && result["objects"].length){
                            result["objects"].forEach((object,index)=>{
                                const { id, name, html, status, validate, type } = object;
                                const dl                =   document.getElementById("dl-line-message-iframe-message-select-sumple").cloneNode(true);
                                dl.id                   =   dl.id.replace("sumple",id);
                                const radio             =   dl.querySelector("dt.dt-line-message-iframe-message-select-radio > input[type=radio]");
                                radio.id                =   "message_" + id;
                                radio.value             =   id;
                                radio.setAttribute("data-name",name);
                                const label_name        =   dl.querySelector("dd.dd-line-message-iframe-message-select-name > label");
                                label_name.setAttribute("for","message_" + id);
                                label_name.textContent  =   name;
                                const label_value       =   dl.querySelector("dd.dd-line-message-iframe-message-select-value > label");
                                label_value.setAttribute("for","message_" + id);
                                label_value.innerHTML   =   html;
                                const button_edit       =   dl.querySelector("button.button-line-message-iframe-messeage-select-button-edit");
                                const button_delete     =   dl.querySelector("button.button-line-message-iframe-messeage-select-button-delete");
                                const button_reference  =   dl.querySelector("button.button-line-message-iframe-messeage-select-button-reference");
                                switch(status){
                                    case("sent"):
                                        [button_reference].forEach(button=>button.classList.add("hidden"));
                                        [button_edit,button_delete].forEach(button=>button.classList.remove("hidden"));
                                        break;
                                    case("draft"):
                                    default:
                                        [button_reference].forEach(button=>button.classList.add("hidden"));
                                        [button_edit,button_delete].forEach(button=>button.classList.remove("hidden"));
                                        break;
                                }
                                body_form.insertBefore(dl,null);
                            });
                        } else {
                            const p         =   document.createElement("p");
                            p.textContent   =   "該当するメッセージはありません";
                            form.insertBefore(p, null);
                        }
                    } else {
                    }

                }
            }
            function edit_message_object(button){
                const dl    =   button.closest("dl.dl-line-message-iframe-message-select-group");
                const id    =   dl.querySelector("input[name='message_object[id]']");
                const type  =   document.getElementById("form-message-select-query").querySelector("select[name='message_object[type]']");
                if(id && type) {
                    const form  =   document.getElementById("form-message-create");
                    form.setAttribute("data-id",id.value);
                    form.querySelector("select[name='type']").value =   type;
                }
            }
        </script>
    </x-slot>
</x-line.frame.iframe>