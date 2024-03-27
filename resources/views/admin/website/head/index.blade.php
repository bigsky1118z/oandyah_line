<x-admin.website.frame.basic title="Head - Setting" heading="基本設定編集">
<form action="/admin/website/head" method="post">
    @csrf
    <h3>デフォルト</h3>
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($heads as $head)
            @php
                $default_head   =   $default_heads->where('tag',$head['tag'])->where('name',$head['name'])->first();
            @endphp
            <tr>
                <td>{{ $head['title'] }}</td>
                <td>
                    @switch($head['tag'])
                        @case('meta')
                            <textarea name="{{ $head['tag'] }}[{{ $head['name'] }}]" cols="80" rows="10">{{ $default_head['value'] }}</textarea>
                            @break
                        @case('link')
                        @case('style')
                            <textarea name="{{ $head['tag'] }}[{{ $head['name'] }}]" cols="80" rows="5">{{ $default_head['value'] }}</textarea>
                            @break
                        @case('title')
                        @default
                            <textarea name="{{ $head['tag'] }}[{{ $head['name'] }}]" cols="80" rows="2">{{ $default_head['value'] }}</textarea>
                    @endswitch
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>カスタマイズ</h3>
    <textarea name="customize[customize]" cols="100" rows="30">{{ $customize_head['value'] }}</textarea>
    <p><button type="submit">save</button></p>
</form>
<x-slot name="script">
</x-slot>
</x-admin.website.frame.basic>