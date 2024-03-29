<x-frame.web>
    <x-slot name="title">TOP[LINE公式アプリ応援屋]</x-slot>
    <x-slot name="head">
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="main">
        <h2>{{ $user->diplay_name ?? $user->name }}</h2>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->apps as $app)
                    <tr>
                        <td>{{ $app->app->name }}</td>
                        <td>{{ $app->role }}</td>
                    </tr>
                    <tr>
                        <td>{{ $app->app->name }}</td>
                        <td>{{ $app->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.web>