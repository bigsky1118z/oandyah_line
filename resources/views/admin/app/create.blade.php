<x-frame.admin>
    <x-slot name="title">LINE公式アプリ応援屋</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <section>
            <form action="/admin/app/{{ $app->id }}" method="post">
                @csrf
                <h2>アプリ情報</h2>
                <button type="submit">保存</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>アプリ名</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td><input type="text" name="name" value="{{ $app->name }}"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit">保存</button>
            </form>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.admin>