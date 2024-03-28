<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>ユーザーページ - TOP</h2>
        <table>
            @foreach (auth()->user()->apps as $app)
                <tr>
                    <td>{{ $app }}</td>
                </tr>
            @endforeach
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>