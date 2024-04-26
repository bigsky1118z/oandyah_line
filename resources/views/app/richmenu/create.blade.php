<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <h3>自動返信 新規作成</h3>
        <form action="/{{ $user->name }}/app/{{ $app->name }}/richmenu" method="post">
            @csrf
            <p><button type="submit">保存</button></p>
            <p><input type="text" name="name" required></p>
            <table>
                <tbody>
                    <tr>
                        <th>名前</th>
                        <td><input type="text" name="name" required></td>
                        <th>サイズ</th>
                        <td>横<input type="number" name="size[width]" required value="2500"> × 縦<input type="number" name="size[height]" required value="1686"></td>
                        <th>メニューに表示されるテキスト</th>
                        <td><input type="checkbox" name="chatBarText" required></td>
                        <th>デフォルト表示</th>
                        <td><input type="checkbox" name="selected" @selected(true)></td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">開始位置</th>
                        <th colspan="2">大きさ</th>
                        <th colspan="3">動作</th>
                    </tr>
                    <tr>
                        <th>X軸</th>
                        <th>Y軸</th>
                        <th>横</th>
                        <th>縦</th>
                        <th>ラベル</th>
                        <th>タイプ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" name="bounds[x]" value="0"></td>
                        <td><input type="number" name="bounds[y]" value="0"></td>
                        <td><input type="number" name="bounds[width]" value="100"></td>
                        <td><input type="number" name="bounds[height]" value="100"></td>
                        <td><input type="text" name="action[label]"></td>
                        <td><input type="text" name=""></td>
                        <td>
                            <select name="action[type]">
                                <option value="postback"></option>
                            </select>
                        </td>
                        <td><input type="text" name="action[data]"></td>
                    </tr>
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
                    const div   =   document.getElementById(`messages-sumple-${value}`).cloneNode(true);
                    div.id      =   `messages-${index}-${value}`;
                    div.querySelectorAll("textarea").forEach(child=>{
                        child.name  =   child.name.replace("sumple",index);
                    });
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