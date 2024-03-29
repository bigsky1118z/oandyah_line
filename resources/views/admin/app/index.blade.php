<x-frame.admin>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <section>
            <h2>アプリ一覧</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apps as $app)
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td><a href="/admin/app/{{ $app->id }}">詳細</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.admin>