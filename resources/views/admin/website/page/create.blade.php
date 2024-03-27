<x-admin.website.frame.basic title="Page - Setting" heading="ページ編集">
@php
if ($errors->any()) {
    $values =  array(
        'id'            =>  old('id'),
        'parent'        =>  old('parent'),
        'title'         =>  old('title'),
        'name'          =>  old('name'),
        'membership'    =>  old('membership'),
    );
} elseif (isset($page)){
    $values =  array(
        'id'            =>  $page->id,
        'parent'        =>  $page->parent,
        'title'         =>  $page->title,
        'name'          =>  $page->name,
        'membership'    =>  $page->membership,
    );
} elseif (!isset($menus)) {
    $values = array(
        'id'            => null,
        'parent'        => null,
        'title'         => null,
        'name'          => null,
        'membership'    => null,
    );
}
@endphp
@if($errors->any())
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
@endif
@if ($resource == "create")
    <form action="/admin/website/page" method="post">
@elseif ($resource == "edit")
    <form action="/admin/website/page/{{ $values['id'] }}" method="post">
    @method('put')
@endif
    @csrf
    <table>
        <tbody>
            <tr>
                <th>parent</th>
                <td><x-admin.website.parts.select.page-parent name="parent" :value="$values['parent']" /></td>
            </tr>
            <tr>
                <th>page</th>
                <td><input type="input" name="name" value="{{ $values['name'] }}"></td>
            </tr>
            <tr>
                <th>title</th>
                <td><input type="input" name="title" value="{{ $values['title'] }}"></td>
            </tr>
            <tr>
                <th>membership</th>
                <td><x-admin.website.parts.select.page-membership name="membership" :value="$values['membership']" /></td>
            </tr>
        </tbody>
    </table>
    <p><td><button type="submit">{{ $resource }}</button></td></p>
</form>
@if ($resource == 'edit')
<p><button type="button" onclick="">delete</button></p>
@endif
<x-slot name="script">
</x-slot>
</x-admin.website.frame.basic>