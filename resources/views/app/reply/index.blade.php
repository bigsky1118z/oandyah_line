<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>メッセージ一覧 - TOP</h2>
        <table>
            <thead>
                <tr>
                    <th style="width:100px;">名前</th>
                    {{-- <th style="width:100px;">ステータス</th> --}}
                    <th style="width:300px;">返答メッセージ</th>
                    <th style="width:50px;">操作</th>
                </tr>
            </thead>    
            <tbody>
                <tr>
                    <td>{{ $app->replies }}</td>
                </tr>
                {{-- @foreach ($app->replies as reply)
                    <tr>
                        <td>{{ reply->name }}</td>
                        <td><x-web.messages :messages="reply->messages" /></td>
                        <td>
                            <button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/reply/create?copy={{ reply->id }}'">複製</button>
                            <button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/reply/{{ reply->id }}'">詳細</button>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            function is_enable(input){
            }
            function is_default(button){
                const id        =   button.getAttribute("data-reply-id");
                const radio     =   document.querySelector("input[type=radio][data-reply-id='"+id+"']");
                radio.checked   =   !radio.checked;
                document.querySelectorAll("input[type=radio]").forEach(input=>{
                    const id            =   input.getAttribute("data-reply-id");
                    const button        =   document.querySelector("button[data-reply-id='"+id+"']");
                    button.textContent  =   input.checked ? "解除" : "設定";
                });
                // 非同期通信
            }
        </script>
    </x-slot>
</x-frame.web>