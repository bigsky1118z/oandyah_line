<x-frame.web>
    <x-slot name="id">user-app-message-create</x-slot>
    <x-slot name="title">送信メッセージ{{ $message->id ? "編集" : "作成" }}</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head">
        <style>
            textarea.message-messages-text-text {
                width: 500px;
                height: 100px;
                background-color: greenyellow;
                border: none;
                border-radius: 10px;
            }
            ul.ul-button-submit {
                display: flex;
            }
        </style>
    </x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/message') }}">送信メッセージ一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>送信メッセージ{{ $message->id ? "編集" : "作成" }}</h3>
            <form action="{{ asset($user->name.'/app/'.$app->client_id.'/message'.($message->id ? '/'. $message->id : null)) }}" method="post">
                @csrf
                <table id="message-condition">
                    <tbody>
                        <tr>
                            <th>メッセージ名</th>
                            <td><input type="text" name="name" value="{{ $message->name ?? null }}"></td>
                        </tr>
                        <tr>
                            <th>送信方法</th>
                            <td>
                                <select name="type" onchange="select_send_type(this);">
                                    <option value="">---</option>
                                    <option value="push" @selected("push" == $message->type)>宛先指定</option>
                                    <option value="broadcast" @selected("broadcast" == $message->type)>全員送信</option>
                                    <option value="narrowcast" @selected("narrowcast" == $message->type)>条件送信</option>
                                </select>
                            </td>
                            <td id="message-type-option">
                                @switch($message->type ?? null)
                                    @case("push") <x-web.messages.create.push id="" :friends="$app->friends" :checked="$message->push" />    @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>通知設定</th>
                            <td>
                                <select name="notification_disabled">
                                    <option value="0" @selected($message->notification_disabled == false ?? false)>通知する</option>
                                    <option value="1" @selected($message->notification_disabled == true ?? false)>通知しない</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>時間指定</th>
                            <td><input type="datetime-local" name="datetime" value="{{ $message->datetime ?? null }}"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <ul>
                                    <li><button type="submit" name="submit" value="save">保存</button></li>
                                </ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <table id="message-messages">
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td>
                                    <select name="messages[{{ $i }}][type]" onchange="select_messages_type(this);" data-index="{{ $i }}">
                                        <option value="">---</option>
                                        <option value="text" @selected("text" == ($message->messages[$i]["type"] ?? null))>テキスト</option>
                                    </select>
                                </td>
                                <td id="messages-{{ $i }}-property">
                                    @switch($message->messages[$i]["type"] ?? null)
                                        @case("text")           <x-web.messages.create.text            id="" :index="$i" :messages="($message->messages[$i] ?? array())" />  @break
                                        {{-- @case("postback")       <x-web.messages.create.postback        id="" :index="$i" :messages="($message->messages[$i] ?? array())" />  @break
                                        @case("message")        <x-web.messages.create.message         id="" :index="$i" :messages="($message->messages[$i] ?? array())" />  @break
                                        @case("uri")            <x-web.messages.create.uri             id="" :index="$i" :messages="($message->messages[$i] ?? array())" />  @break
                                        @case("datetimepicker") <x-web.messages.create.datetimepicker  id="" :index="$i" :messages="($message->messages[$i] ?? array())" />  @break
                                        @case("richmenuswitch") <x-web.messages.create.richmenuswitch  id="" :index="$i" :messages="($message->messages[$i] ?? array())" />  @break --}}
                                    @endswitch
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <ul class="ul-button-submit">
                                    <li><button type="submit" name="submit" value="save">保存</button></li>
                                    <li><button type="submit" name="submit" value="send">送信</button></li>
                                </ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </section>
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden">
        {{-- message-type --}}
        <x-web.messages.create.push              id="sumple-message-type-push"                    :friends="($app->friends ?? array())" />

        {{-- message-type --}}
        <x-web.messages.create.text            id="sumple-message-messages-type-text"              index="{sumple}" :messages="array()" />
        {{-- <x-web.messages.create.message         id="sumple-message-messages-type-message"           index="{sumple}" :messages="array()" />
        <x-web.messages.create.uri             id="sumple-message-messages-type-uri"               index="{sumple}" :messages="array()" />
        <x-web.messages.create.datetimepicker  id="sumple-message-messages-type-datetimepicker"    index="{sumple}" :messages="array()" />
        <x-web.messages.create.richmenuswitch  id="sumple-message-messages-type-richmenuswitch"    index="{sumple}" :messages="array()" /> --}}
    </x-slot>
    <x-slot name="script">
        <script>
            function select_send_type(select){
                const value         =   select.value;
                const target        =   document.getElementById("message-type-option");
                target.innerHTML    = '';
                const sumple        =   document.getElementById("sumple-message-type-" + value);
                if(sumple){
                    const div       =   sumple.cloneNode(true);
                    div.removeAttribute("id");
                    target.appendChild(div);
                }
            }
            function select_messages_type(select){
                const value         =   select.value;
                const index         =   select.getAttribute("data-index");
                const target        =   document.getElementById("messages-"+index+"-property");
                target.innerHTML    = '';
                const sumple        =   document.getElementById("sumple-message-messages-type-" + value);
                if(sumple){
                    const div   =   sumple.cloneNode(true);
                    div.removeAttribute("id");
                    div.querySelectorAll("input,select,textarea").forEach(node=>{
                        const name  =   node.name;
                        node.name   =   name.replace("[{sumple}]","["+index+"]");
                    });
                    target.appendChild(div);
                }
            }
        </script>
    </x-slot>
</x-frame.web>

