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
                            <td>
                                <select name="messages[{{ $i }}][type]" onchange="confirm_change(this);" data-previous-value="{{ $i===1 ? "text" : "" }}" @required($i===1)>
                                    @if ($i !== 1)
                                        <option value="">---</option>
                                    @endif
                                    <option value="text" @selected($i===1)>テキスト</option>
                                    <option value="template">テンプレート</option>
                                </select>
                            </td>
                            <td>
                                @if ($i===1)
                                    <textarea name="messages[{{ $i }}][text]" cols="50" rows="5"></textarea>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </form>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            function confirm_change(select){
                const value     =   select.value;
                const result    =   window.confirm("タイプを変更すると対象のメッセージの内容が失われます。\nタイプを変更しますか？");
                if(result || value ==""){
                    select.setAttribute("data-previous-value", value);
                    console.log("true", value);
                } else {
                    select.value    =   select.getAttribute("data-previous-value");
                    console.log("false", select.getAttribute("data-previous-value"));
                }
            }
        </script>
    </x-slot>
</x-frame.web>