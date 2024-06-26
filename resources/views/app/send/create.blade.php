<x-frame.web>
    <x-slot name="id">user-app-send-create</x-slot>
    <x-slot name="title">送信メッセージ{{ $send->id ? "編集" : "作成" }}</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head">
        <style>
            textarea.send-messages-text-text {
                width: 500px;
                height: 100px;
                background-color: greenyellow;
                border: none;
                border-radius: 10px;
            }
        </style>
    </x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/send') }}">送信メッセージ一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>送信メッセージ{{ $send->id ? "編集" : "作成" }}</h3>
            <form action="{{ asset($user->name.'/app/'.$app->client_id.'/send'.($send->id ? '/'. $send->id : null)) }}" method="post">
                @csrf
                <table id="send-condition">
                    <tbody>
                        <tr>
                            <td>
                                <select name="mode" onchange="select_mode(this);">
                                    <option value="">---</option>
                                    <option value="to">宛先指定</option>
                                    <option value="broadcast">全員送信</option>
                                    <option value="narrowcast">条件送信</option>
                                </select>
                            </td>
                            <td id="mode-option"> 
                            </td>
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
                <table id="send-messages">
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td>
                                    <select name="messages[{{ $i }}][type]" onchange="select_messages_type(this);" data-index="{{ $i }}">
                                        <option value="">---</option>
                                        <option value="text">テキスト</option>
                                    </select>
                                </td>
                                <td id="messages-{{ $i }}-property">
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <ul>
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
    <x-slot name="footer">
        {{ $app->friends }}
    </x-slot>
    <x-slot name="hidden">
        <x-web.sends.create.to              id="sumple-mode-to"                         :friends="$app->friends" />
        <x-web.sends.create.text            id="sumple-messages-type-text"              index="{sumple}" :messages="array()" />
        {{-- <x-web.sends.create.message         id="sumple-messages-type-message"           index="{sumple}" :messages="array()" />
        <x-web.sends.create.uri             id="sumple-messages-type-uri"               index="{sumple}" :messages="array()" />
        <x-web.sends.create.datetimepicker  id="sumple-messages-type-datetimepicker"    index="{sumple}" :messages="array()" />
        <x-web.sends.create.richmenuswitch  id="sumple-messages-type-richmenuswitch"    index="{sumple}" :messages="array()" /> --}}
    </x-slot>
    <x-slot name="script">
        <script>
            function select_mode(select){
                const value         =   select.value;
                const target        =   document.getElementById("mode-option");
                target.innerHTML    = '';
                const sumple        =   document.getElementById("sumple-mode-" + value);
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
                const sumple        =   document.getElementById("sumple-messages-type-" + value);
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

