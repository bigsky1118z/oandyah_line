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
                    <th style="width:280px;">返答メッセージ</th>
                    <th style="width:300px;">条件</th>
                    <th style="width:100px;">操作</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($app->replies as $reply)
                    <tr>
                        <td>{{ $reply->name }}</td>
                        {{-- <td>{{ $reply->status }}</td> --}}
                        <td><x-web.messages :messages="$reply->messages" /></td>
                        <td>
                            <ul>
                                @foreach ($reply->conditions as $condition)
                                    <li>
                                        <dl style="display:flex;">
                                            <dd style="width:75px">{{ $condition->type }}</dd>
                                            <dd style="width: 100px">{{ $condition->condition["match"] ?? null }}</dd>
                                            <dd style="width: 125px">{{ $condition->condition["keyword"] ?? null }}</dd>
                                        </dl>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/reply/create?copy={{ $reply->id }}'">複製</button>
                            <button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/reply/{{ $reply->id }}'">詳細</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>{{ json_encode($conditons) ?? null }}</p>
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