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
                @foreach ($app->messages->groupBy(fn($message)=>$message->condition["type"]) as  $name => $message)
                    <tr>
                        <td>{{ $name }}</td>
                        {{-- <td>{{ $message->condition["type"] }}</td>
                        <td><input type="checkbox" @checked($message->enable)></td>
                        <td><input type="radio" name="" id=""></td>
                        <td><x-web.messages :messages="$message->messages" /></td>
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/message/{{ $message->id }}'">詳細</button></td> --}}
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>