<x-admin.website.frame.basic title="Menu Setting" heading="メニュー編集">
<table>
    <thead>
        <tr>
            <th></th>
            <th>link</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
        <tr>
            <td>{{ $menu->index }}</td>
            <td>
                @if ($menu->page_id && $menu->title)
                    <a href="/{{ $menu->page_item->name }}" target="_blank" rel="noopener noreferrer">{{ $menu->title }}</a>
                @elseif ($menu->page_id && !$menu->title)
                    <a href="/{{ $menu->page_item->name }}" target="_blank" rel="noopener noreferrer">{{ $menu->page_item->title }}</a>
                @elseif ($menu->href && $menu->title)
                    <a href="{{ $menu->href }}" target="_blank" rel="noopener noreferrer">{{ $menu->title }}</a>                            
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-admin.website.frame.basic>