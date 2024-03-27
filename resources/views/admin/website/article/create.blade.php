<x-admin.website.frame.basic title="articles" heading="記事ページ編集">
@php
    if ($errors->any()) {
        $values =  array(
            'page_name'         => old('page_name'),
            'page_id'           => old('page_id'),
            'path'              => old('path'),
            'title'             => old('title'),
            'body'              => old('body'),
            'public_setting'    => old('public_setting'),
            'public_datetime'   => old('public_datetime'),
        );
        if(!old("public_datetime")){
            $values["public_datetime"]  = date('Y-m-d H:i:s');
        }
    } elseif (isset($article)){
        $values =  array(
            'page_name'         => $article->page->name,
            'page_id'           => $article->page_id,
            'path'              => $article->path,
            'title'             => $article->title,
            'body'              => $article->body,
            'public_setting'    => $article->public_setting,
            'public_datetime'   => $article->public_datetime,
        );
    } elseif (!isset($article)) {
        $values = array(
            'page_name'         => $page_name,
            'page_id'           => null,
            'path'              => null,
            'title'             => null,
            'body'              => null,
            'public_setting'    => 0,
            'public_datetime'   => date('Y-m-d H:i:00'),
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
    <form action="/admin/website/article/{{ $values['page_name'] }}" method="post">
    <input type="hidden" name="page_name" value="{{ $values['page_name'] }}">
@elseif ($resource=='edit')
    <form action="/admin/website/article/{{ $values['page_name'] }}/{{ $values['path'] }}" method="post">
    <input type="hidden" name="page_id" value="{{ $values['page_id'] }}">
    @method("put")
@endif
    @csrf
    <table>
        <tbody>
            <tr>
                <th>ページID</th>
                <td>
                    <input type="text" name="path" value="{{ $values['path'] }}">
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
                <td><input type="text" name="title" value="{{ $values['title'] }}"></td>
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
    <form action="/admin/website/article/{{ $values['page_name'] }}/{{ $values['path'] }}" method="post" onsubmit="return confirm('Are you sure you want to permanently delete this article ?')">
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
</x-admin.frame.setting>