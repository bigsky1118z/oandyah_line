<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>送信一覧 - TOP</h2>
        <table>
            <thead>
                <tr>
                    <th>index</th>
                    <th>type</th>
                    <th>response_code</th>
                    <th>message</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($app->sends as $index => $send)
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ $send->type }}</td>
                        <td>{{ $send->response_code }}</td>
                        <td>{{ $send->message }}</td>
                        <td>{{ $send }}</td>
                        {{-- <td>{{ $send }}</td> --}}
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/friend/{{ $send->id }}'">詳細</button></td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>

