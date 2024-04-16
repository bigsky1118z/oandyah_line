<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>メッセージ一覧 - TOP</h2>
        @foreach (["follow","message","postback"] as $type)
            <h3>{{ $type }}</h3>
            @foreach ($app->messages->groupBy(fn($message)=>$message->condition["type"])[$type] as $message)
                <table>
                    <thead>
                        <tr>
                            <th style="width:30px;">有効</th>
                            <th style="width:100px;">名前</th>
                            {{-- <th style="width:100px;">ステータス</th> --}}
                            <th style="width:100px;">トリガー</th>
                            <th style="width:300px;">返答メッセージ</th>
                            <th style="width:50px;">優先度</th>
                            <th style="width:70px;">デフォルト</th>
                            <th style="width:50px;">操作</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <tr>
                            <td><input type="checkbox" @checked($message->enable)></td>
                            <td>{{ $message->name }}</td>
                            {{-- <td>{{ $message->status }}</td> --}}
                            <td>
                                @switch($message->condition["type"])
                                    @case("message")
                                        {{ $message->condition["keyword"] ?? null }}
                                        @break
                                    @case("postback")
                                        @break
                                    @default
                                @endswitch
                            </td>
                            <td><x-web.messages :messages="$message->messages" /></td>
                            <td>{{ $message->priority }}</td>
                            <td>
                                <input type="radio" class="hidden" name="default[{{ $type }}]" data-message-id="{{ $message->id }}" value="{{ $message->id }}" @checked($message->default)>
                                <button data-message-id="{{ $message->id }}" onclick="is_default(this);">{{ $message->default ? "解除" : "設定" }}</button>
                            </td>
                            <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/message/{{ $message->id }}'">詳細</button></td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            function is_default(button){
                const id    =   button.getAttribute("data-message-id");
                console.log(id);
                const radio =   document.querySelector("input[type=radio]");
                console.log(radio);
                if(radio.checked){
                    radio.checked       = false;
                    button.textContent  = "設定";  
                } else {
                    radio.checked       = true;
                    button.textContent  = "解除";
                }
            }
        </script>
    </x-slot>
</x-frame.web>