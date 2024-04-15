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
                            <ul>
                                @foreach ($message->messages as $message_object)
                                    @switch($message_object["type"])
                                        @case("text")
                                            <li><x-web.message_object.text :text="$message_object['text']" /></li>
                                            @break
                                        @case("template")                                            
                                            <li><x-web.message_object.template :template="$message_object['template']" /></li>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    <li></li>
                                @endforeach
                            </ul>
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