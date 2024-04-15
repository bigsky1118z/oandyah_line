<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>自動一覧 - TOP</h2>
        <table>
            <thead>
                <tr>
                    <th>index</th>
                    <th>type</th>
                    <th>message</th>
                    <th>default</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($app->autos as $index => $auto)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $auto->type }}</td>
                        <td>@isset($auto->message->messages )<x-web.messages :messages="$auto->message->messages" />@endisset</td>
                        <td><input type="radio" name="{{ $auto->type }}" id="" @checked( $auto->is_default())></td>
                        {{-- <td>{{ $send }}</td> --}}
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/friend/{{ $auto->id }}'">詳細</button></td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>

