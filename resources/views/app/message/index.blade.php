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
                </tr>
            </thead>    
            <tbody>
                @foreach ($app->messages as $message)
                    <tr>
                        <td>
                            @foreach ($message->messages as $message_object)
                                <dl>
                                    <dt>{{ $message_object["type"] ?? ""}}</dt>
                                    @switch($message_object["type"])
                                        @case("text")
                                            <dd>{{ $message_object["text"] ?? ""}}</dd>
                                            @break
                                        @case("template")
                                            <dd>{{ json_encode($message_object["template"]) ?? ""}}</dd>                                            
                                            @break
                                        @default
                                    @endswitch
                                </dl>
                            @endforeach
                        </td>
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/message/{{ $message->id }}'">詳細</button></td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>