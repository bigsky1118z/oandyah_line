<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <h3>自動返信 新規作成</h3>
        <form action="/{{ $user->name }}/app/{{ $app->name }}/reply" method="post">
            @csrf
            <p><button type="submit">保存</button></p>
            <p><input type="text" name="name" required></p>
            <table>
                <thead>
                    <tr>
                        <th>タイプ</th>
                        <th>メッセージ</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td id="td-messages-{{ $i }}-type">
                                <select name="messages[{{ $i }}][type]" onchange="change_message_type(this);" data-previous-value="{{ $i===1 ? "text" : "" }}" data-index="{{ $i }}" @required($i===1)>
                                    @if ($i !== 1)
                                        <option value="">---</option>
                                    @endif
                                    <option value="text" @selected($i===1)>テキスト</option>
                                    <option value="template">テンプレート</option>
                                </select>
                            </td>
                            <td id="td-messages-{{ $i }}-message">
                                @if ($i===1)
                                    <div id="messages-{{ $i }}-text">
                                        <textarea name="messages[{{ $i }}][text]" cols="50" rows="5"></textarea>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <p><button type="submit">保存</button></p>
        </form>
    </x-slot>
    <x-slot name="hidden">
        <div id="messages-sumple-text">
            <textarea name="messages[sumple][text]" cols="50" rows="5"></textarea>
        </div>
        <div id="messages-sumple-template">
            <p>まだないよー</p>
        </div>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            function change_message_type(select){
                const value     =   select.value;
                const index     =   select.getAttribute("data-index");
                const previous  =   select.getAttribute("data-previous-value");
                const result    =   window.confirm("タイプを変更すると対象のメッセージの内容が失われます。\nタイプを変更しますか？");
                if(result || previous == ""){
                    select.setAttribute("data-previous-value", value);
                    const div   =   document.getElementById(`messages-sumple-${value}`).cloneNode();
                    console.log(div);
                    div.id      =   `messages-${index}-${value}`;
                    const td    =   document.getElementById(`td-messages-${index}-message`);
                    while(td.firstChild){
                        td.removeChild(td.firstChild);
                    }
                    td.appendChild(div);
                } else {
                    select.value    =   previous;
                }
                
            }
        </script>
    </x-slot>
</x-frame.web>