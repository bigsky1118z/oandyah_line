<x-frame.web>
    <x-slot name="id">user-app-message-create<message_object./x-slot>
    <x-slot name="title">送信メッセージ{{ $message->id ? "編集" : "作成" }}</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head">
        <style>
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
                                    @case("push")       <x-web.messages.create.type.push id="" :friends="$app->friends" :checked="$message->push" />    @break
                                    {{-- @case("narrowcast") <x-web.messages.create.type.push id="" :friends="$app->friends" :checked="$message->push" />    @break --}}
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
                <table id="message-messages" class="message-objects">
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td>
                                    <x-web.messages.create.message_types    :index="$i" :object="($message->messages[$i] ?? array())" onchange="select_messages_type(this);" />
                                </td>
                                <td id="messages-{{ $i }}-object">
                                    <x-web.messages.create.message_objects  :index="$i" :object="($message->messages[$i] ?? array())" />
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
        <x-web.messages.create.type.push    id="sumple-message-type-push"   :friends="($app->friends ?? array())" />

        {{-- message-type --}}
        <x-web.messages.create.message_object_sumples />
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
        </script>
        <x-web.messages.create.message_scripts />
    </x-slot>
</x-frame.web>

