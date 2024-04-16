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
                    <th>enable</th>
                    <th>type</th>
                    <th>trigger</th>
                    <th>message</th>
                    <th>default</th>
                </tr>
            </thead>    
            <tbody>
                {{ $autos }}
                {{-- @foreach ($autos as $type => auto)
                    {{ $type }}
                    {{ $auto }}
                @endforeach --}}
                @foreach ($app->autos as $type => $auto)
                    <tr>
                        <td><input type="checkbox" name="" value="{{ $app->id }}" @checked($auto->enable) onclick="is_enable(this);"></td>
                        <td>{{ $auto->type }}</td>
                        @switch($auto->type)
                            @case("message")
                                <td>{{ $auto->condition["keyword"] ?? null }}</td>
                                @break
                            @case("postback")
                                <td></td>
                                @break
                            @default
                                <td></td>
                        @endswitch
                        </td>
                        <td>@isset($auto->message->messages )<x-web.messages :messages="$auto->message->messages" />@endisset</td>
                        <td><input type="radio" name="{{ $auto->type }}" id="" @checked( $auto->is_default())></td>
                        <td><button type="button" onclick="location.href='/{{ $user->name }}/app/{{ $app->name }}/auto/{{ $auto->id }}'">詳細</button></td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            const token =   document.querySelector("meta[name='csrf-token']").getAttribute("content");
    
            function is_enable(checkbox){
                console.log("standby");
                // const form  =   new FormData();
                //     form.append("_token", token);
                //     form.append("id", checkbox.value);
                //     form.append("enable", checkbox.checked);
                // const options   =   {
                //     "method"    :   "post",
                //     "body"      :   form,
                // };
                // fetch("/{{ $user->name }}/app/{{ $app->name }}/auto/enable", options).then(response => response.ok ? location.reload() : console.log(response));
            }
        </script>
        </x-slot>
</x-frame.web>

