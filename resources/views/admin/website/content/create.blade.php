<x-admin.website.frame.basic title="Contents" heading="コンテンツ編集">
@php
    if ($errors->any()) {
        $values =  array(
            'id'                => old('id'),
            'page_name'         => old('page_name'),
            'page_title'        => old('page_title'),
            'body'              => old('body'),
            'public_setting'    => old('public_setting'),
            'public_datetime'   => old('public_datetime'),
        );
        if(!old("public_datetime")){
            $values["public_datetime"]  = date('Y-m-d H:i:00');
        }
    } elseif (isset($content)){
        $values =  array(
            'id'                => $content->id,
            'page_name'         => $content->page->name,
            'page_title'        => $content->page->title,
            'body'              => $content->body,
            'public_setting'    => $content->public_setting,
            'public_datetime'   => $content->public_datetime,
        );
    } elseif (!isset($content)) {
        $values = array(
            'id'                => null,
            'page_name'         => null,
            'page_title'        => null,
            'body'              => null,
            'public_setting'    => 0,
            'public_datetime'   => date('Y-m-d H:i:s'),
        );
    }
@endphp
    <x-slot name="head" >
        <x-quill-head />
    </x-slot>

    <h3>{{ $resource }}</h3>
    @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    @endif
    @if ($resource=='create')
        <form action="/admin/website/content" method="post">
    @elseif ($resource=='edit')
        <form action="/admin/website/content/{{ $values['id'] }}" method="post">
        @method('put')
    @endif
        @csrf
        <table>
            <tbody>
                <tr>
                    <th>ページID</th>
                    <td>
                        @if ($resource=='create')
                        <input type="text" name="page_name" value="{{ $values['page_name'] }}">
                        @elseif ($resource=='edit')
                        <input type="hidden" name="page_name" value="{{ $values['page_name'] }}">
                        {{ $values['page_name'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>公開設定</th>
                    <td>
                        <label for="public_setting_0">
                            <input type="radio" name="public_setting" id="public_setting_0" value="0" @if ($values['public_setting']==0) checked @endif>
                            <span>非公開</span>
                        </label>
                        <label for="public_setting_1">
                            <input type="radio" name="public_setting" id="public_setting_1" value="1" @if ($values['public_setting']==1) checked @endif>
                            <span>公開</span>
                            <input type="datetime-local" name="public_datetime" value="{{ $values['public_datetime'] }}" oninput="isFuture()">
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <th>タイトル</th>
                    <td><input type="text" name="page_title" value="{{ $values['page_title'] }}"></td>
                </tr>
                <tr>
                    <th>記事</th>
                    <td>
                        <x-quill-editor :text="$values['body']" name="body" />
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" onclick="window.onbeforeunload=null;" value="save">
    </form>
    @if ($resource=='edit')
        <h3>delete</h3>
        <form action="/admin/website/content/{{ $values['id'] }}" method="post" onsubmit="return confirm('Are you sure you want to permanently delete this content ?')">
            @method('delete')
            @csrf
            <input type="submit" onclick="window.onbeforeunload=null;" value="delete">
        </form>
    @endif
    <x-slot name="script">
        <x-quill-script />
        <x-.admin.website.parts.script.onbeforeunload />
        <script>

        </script>
    </x-slot>
</x-admin.website.frame.basic>