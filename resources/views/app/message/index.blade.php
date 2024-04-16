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
                            <th style="width=100px"></th>
                            <th style="width=100px">名前</th>
                            {{-- <th style="width=100px">ステータス</th> --}}
                            <th style="width=100px">トリガー</th>
                            <th style="width=100px">返答メッセージ</th>
                            <th style="width=100px">優先度</th>
                            <th style="width=100px">デフォルト返信</th>
                            <th style="width=100px">操作</th>
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
                            <td><input type="radio" name="default[{{ $type }}]" id="" @checked($message->default)></td>
                            <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/message/{{ $message->id }}'">詳細</button></td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>