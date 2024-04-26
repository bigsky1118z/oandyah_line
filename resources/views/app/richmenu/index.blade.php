<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <h3>リッチメニュー 一覧</h3>
        <button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/richmenu/create'">新規作成</button>
        <h3></h3>
        <table>
            <thead>
                <tr>
                    <th style="width:100px;">名前</th>
                    {{-- <th style="width:100px;">ステータス</th> --}}
                    <th style="width:280px;">返答メッセージ</th>
                    <th style="width:100px;">操作</th>
                    <th style="width:300px;">条件</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($richmenus as $richmenu)
                    <tr>
                        <td>{{ $richmenu["richMenuId"] ?? null }}</td>
                        <td>{{ $richmenu["size"]["width"] ?? null }}</td>
                        <td>{{ $richmenu["size"]["height"] ?? null }}</td>
                        <td>{{ $richmenu["chatBarText"] ?? null }}</td>
                        <td>{{ $richmenu["selected"] ?? null }}</td>
                        <td>
                            @isset($richmenu["areas"])
                                <ul>
                                    @foreach ($richmenu["areas"] as $area)
                                        <li>{{ $area["action"]["type"] ?? null }}</li>
                                    @endforeach
                                </ul>
                            @endisset
                        </td>
                        <td>
                            <button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/richmenu/{{ $richmenu['richMenuId'] ?? null }}'">詳細</button>
                        </td>    
                    </tr>
                @endforeach
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
                const id        =   button.getAttribute("data-richmenu-id");
                const radio     =   document.querySelector("input[type=radio][data-richmenu-id='"+id+"']");
                radio.checked   =   !radio.checked;
                document.querySelectorAll("input[type=radio]").forEach(input=>{
                    const id            =   input.getAttribute("data-richmenu-id");
                    const button        =   document.querySelector("button[data-richmenu-id='"+id+"']");
                    button.textContent  =   input.checked ? "解除" : "設定";
                });
                // 非同期通信
            }
        </script>
    </x-slot>
</x-frame.web>