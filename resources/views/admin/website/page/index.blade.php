<x-admin.website.frame.basic title="Page - Setting" heading="登録ページ一覧">
<x-slot name="head">
</x-slot>
<p><button type="button" onclick="window.location.href = '/admin/website/page/create';">add new page</button></p>
@foreach ($pages as $parent => $items)
@if ($parent == 'protected')
    @continue
@else
    <h3>{{ $parent }}</h3>
    <table id="{{ $parent }}">
        <thead>
            <tr>
                <th>ページタイトル</th>
                <th>ページID</th>
                <th>公開範囲</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index=>$item)
            <tr>
                <td>{{ $item['title'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ App\Models\Website\Page::$membership_rules[$item['membership']] }}</td>
                <td><button type="button" onclick="window.location.href = '/admin/website/page/{{ $item['id'] }}/edit';">edit</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endforeach
<x-slot name="script">
</x-slot>
</x-admin.website.frame.basic>