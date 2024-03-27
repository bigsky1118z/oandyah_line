<x-admin.website.frame.basic title="Menu Setting" heading="メニュー一覧">
<p>
    <button type="button" onclick="window.location.href = '/admin/website/menu/create';">create new menu</button>
</p>
<table>
    <thead>
        <tr>
            <th>メニュー名</th>
            <th>確認</th>
            <th>編集</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
        <tr>
            <td>{{ $menu->title }}</td>
            <td><a href="/admin/website/menu/{{ $menu->id }}">show</a></td>
            <td><a href="/admin/website/menu/{{ $menu->id }}/edit">edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-admin.website.frame.basic>