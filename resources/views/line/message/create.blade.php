@php
    use App\Models\Line\LineMessage;
    $types  =   LineMessage::$types;
    unset($types["reply"]);

    $values =   array();
    if(isset($message)){
        $values =   $message;
    }
@endphp
<x-line.frame.basic>
<x-slot name="id">message</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > <a href="/line/{{ $line->name }}/message">送信メッセージ</a> > {{ isset($values["id"]) ? "編集" : "作成" }}</h2>
<section id="create">
    <form action="/line/{{ $line->name }}/message{{ isset($values["id"]) ? "/" . $values["id"] : null }}" method="post">
        @csrf
        <h3>作成フォーム</h3>
        <dl id="dl-line-message-create">
            <dt class="dt-line-message-create-header">
                <dl>
                    <dd>
                        <input type="submit" name="submit" value="送信">
                        <input type="submit" name="submit" value="下書き保存">
                    </dd>
                    <dd>{{ $line->get_bot_message_quota_limit() }}</dd>
                </dl>
            </dt>
            <dd class="dd-line-message-create-body">
                <dl id="dl-line-message-create-type">
                    <dt class="dt-line-message-create-title">送信種別</dt>
                    <dd class="dd-line-message-create-value">
                        <select name="type" onchange="select_type();">
                            @foreach ($types as $type_key => $type_value)
                                <option value="{{ $type_key }}" @selected(isset($values["type"]) && $type_key == $values["type"])>{{ $type_value }}</option>
                            @endforeach
                        </select>
                    </dd>
                </dl>
                <dl id="dl-line-message-create-to">
                    <dt class="dt-line-message-create-title">送信先</dt>
                    <dd class="dd-line-message-create-value">
                        <button type="button" onclick="set_iframe('dl-line-message-create-to');">選択</button>
                        <div class="iframe-result"></div>
                    </dd>
                    <dd class="dd-line-message-create-preview iframe-preview"></dd>
                </dl>
                <dl id="dl-line-message-create-recipient">
                    <dt class="dt-line-message-create-title">recipient</dt>
                    <dd class="dd-line-message-create-value">
                        <button type="button" onclick="set_iframe('dl-line-message-create-recipient');">選択</button>
                        <div class="iframe-result"></div>
                    </dd>
                    <dd class="dd-line-message-create-preview iframe-preview"></dd>
                </dl>
                <dl id="dl-line-message-create-filter">
                    <dt class="dt-line-message-create-title">filter</dt>
                    <dd class="dd-line-message-create-value">
                        <button type="button" onclick="set_iframe('dl-line-message-create-filter');">選択</button>
                        <div class="iframe-result"></div>
                    </dd>
                    <dd class="dd-line-message-create-preview iframe-preview"></dd>
                </dl>
                <dl id="dl-line-message-create-limit">
                    <dt class="dt-line-message-create-title">limit</dt>
                    <dd class="dd-line-message-create-value">
                        <button type="button" onclick="set_iframe('dl-line-message-create-limit');">選択</button>
                        <div class="iframe-result"></div>
                    </dd>
                    <dd class="dd-line-message-create-preview iframe-preview"></dd>
                </dl>
                <dl id="dl-line-message-create-notification">
                    <dt class="dt-line-message-create-title">通知</dt>
                    <dd class="dd-line-message-create-value">
                        <select name="notification">
                            <option value="notification">ON</option>
                            <option value="notification_disabled">OFF</option>
                        </select>
                    </dd>
                </dl>
                @for ($i=1; $i<=5; $i++)
                    <dl id="dl-line-message-create-message_{{ $i }}" class="dl-line-message-create-message">
                        <dt class="dt-line-message-create-title">メッセージ {{ $i }}</dt>
                        <dd class="dd-line-message-create-value">
                            <button type="button" onclick="set_iframe('dl-line-message-create-message_{{ $i }}');">選択</button>
                            <div class="iframe-result"></div>
                        </dd>
                        <dd class="dd-line-message-create-preview iframe-preview"></dd>
                    </dl>
                @endfor
            </dd>
        </dl>
    </form>
</section>
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="iframe">
    <iframe id="iframe-dl-line-message-create-to"           src="/line/{{ $line->name }}/message/iframe/to{{ isset($values['id']) ? '/'.$values['id'] : null }}"                frameborder="5" loading="eager" onload="get_iframe();"></iframe>
    <iframe id="iframe-dl-line-message-create-message_1"    src="/line/{{ $line->name }}/message/iframe/message{{ isset($values['id']) ? '/' . $values['id'] : null }}?index=1" frameborder="5" loading="eager" onload="get_iframe();"></iframe>
    <iframe id="iframe-dl-line-message-create-message_2"    src="/line/{{ $line->name }}/message/iframe/message{{ isset($values['id']) ? '/' . $values['id'] : null }}?index=2" frameborder="5" loading="eager" onload="get_iframe();"></iframe>
    <iframe id="iframe-dl-line-message-create-message_3"    src="/line/{{ $line->name }}/message/iframe/message{{ isset($values['id']) ? '/' . $values['id'] : null }}?index=3" frameborder="5" loading="eager" onload="get_iframe();"></iframe>
    <iframe id="iframe-dl-line-message-create-message_4"    src="/line/{{ $line->name }}/message/iframe/message{{ isset($values['id']) ? '/' . $values['id'] : null }}?index=4" frameborder="5" loading="eager" onload="get_iframe();"></iframe>
    <iframe id="iframe-dl-line-message-create-message_5"    src="/line/{{ $line->name }}/message/iframe/message{{ isset($values['id']) ? '/' . $values['id'] : null }}?index=5" frameborder="5" loading="eager" onload="get_iframe();"></iframe>
</x-slot>
<x-slot name="script">
    <script>
        select_type();
        function select_type(){
            const select    =   document.querySelector("select[name=type]");
            if(select){
                const value     =   select.value;
                const to      =   document.getElementById("dl-line-message-create-to");
                const recipient =   document.getElementById("dl-line-message-create-recipient");
                const filter    =   document.getElementById("dl-line-message-create-filter");
                const limit     =   document.getElementById("dl-line-message-create-limit");
                switch(value){
                    case("push"):
                        [to].forEach(dl => dl.classList.remove("hidden"));
                        [recipient,filter,limit].forEach(dl => dl.classList.add("hidden"));
                        break;
                    case("narrowcast"):
                        [recipient,filter,limit].forEach(dl => dl.classList.remove("hidden"));
                        [to].forEach(dl => dl.classList.add("hidden"));
                        break;
                    case("broadcast"):
                        [to,recipient,filter,limit].forEach(dl => dl.classList.add("hidden"));
                        break;
                }
            }
        }
        function set_iframe(id){
            const div   =   document.getElementById("iframe");
            div.querySelectorAll("iframe").forEach(iframe => {
                if(iframe.id == `iframe-${id}`){
                    iframe.classList.remove("hidden");
                } else {
                    iframe.classList.add("hidden");
                }
            });
            div.classList.remove("hidden");
        }
        function get_iframe(){
            const div       =   document.getElementById("iframe");
            div.classList.add("hidden");
            div.querySelectorAll("iframe").forEach(iframe => {
                iframe.classList.add("hidden");
                const id        =   iframe.id.replace("iframe-","");
                const content   =   iframe.contentDocument;
                const result    =   document.querySelector(`#${id} .iframe-result`);
                if(result){
                    result.querySelectorAll("input").forEach(input => input.remove());
                    content.querySelectorAll("input:checked, select").forEach(input => {
                        const element   =   document.createElement("input");
                        element.type    =   "hidden";
                        element.name    =   input.name;
                        element.value   =   input.value;
                        switch(id){
                            case("dl-line-message-create-to"):
                                result.appendChild(element);
                                break;
                            case("dl-line-message-create-message_1"):
                            case("dl-line-message-create-message_2"):
                            case("dl-line-message-create-message_3"):
                            case("dl-line-message-create-message_4"):
                            case("dl-line-message-create-message_5"):
                                const pattern   =   /^message_object\[.*\]$/;
                                if(pattern.test(element.name)){
                                    const index     =   id.replace("dl-line-message-create-message_","");
                                    element.name    =   element.name.replace("message_object", "message_object["+ index +"]");
                                    input.hasAttribute("data-name") ? element.setAttribute("data-name",input.getAttribute("data-name")) : null;
                                    result.appendChild(element);
                                }
                                break;
                        }
                    });
                    set_iframe_preview(id);
                }
            });
        }
        function set_iframe_preview(id){
            const result        =   document.querySelector(`#${id} .iframe-result`);
            const preview       =   document.querySelector(`#${id} .iframe-preview`);
            preview.innerHTML   =   null;
            switch(id){
                case("dl-line-message-create-to"):
                    const count         =   result.children.length;
                    preview.textContent =   count + " 名";
                    break;
                case("dl-line-message-create-message_1"):
                case("dl-line-message-create-message_2"):
                case("dl-line-message-create-message_3"):
                case("dl-line-message-create-message_4"):
                case("dl-line-message-create-message_5"):
                    const type  =   result.querySelector("input[name^='message_object['][name$='][type]']");
                    const name  =   result.querySelector("input[name^='message_object['][name$='][id]']");
                    if(type && name){
                        preview.innerHTML   =   type.value + "<br />" + name.getAttribute("data-name");
                    }
                    break;
            }

        }

    </script>
</x-slot>
</x-line.frame.basic>