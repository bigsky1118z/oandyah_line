<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
        <style>
            ul.ul-index-message > li {
                border: 1px solid #000000;
                border-radius: 10px;
                background-color: greenyellow;
                padding: 5px;
            }
        </style>
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
                        <td><x-web.messages :messages="$message->messages" /></td>
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/message/{{ $message->id }}'">詳細</button></td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>