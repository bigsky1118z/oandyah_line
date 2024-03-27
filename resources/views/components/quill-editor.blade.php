@props(array(
    'text' => null,
    'name' => 'editor',
))
<div id="editor">
    {!! $text !!}
</div>
<input type="hidden" id="editor-input" name="{{ $name }}" value="{{ $text }}">