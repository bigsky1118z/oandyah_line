@props(array(
    'type'          =>  "text",
    'id'            =>  null,
    'value'         =>  null,
    'name'          =>  null,
    'placeholder'   =>  null,
    'required'      =>  null,
    'readonly'      =>  null,
    'onchange'      =>  null,
    'oninput'       =>  null,
))
<input 
type="{{ $type }}" 
@if ($name)
name="{{ $name }}" 
@endif
@if ($id)
id="{{ $id }}" 
@endif
@if ($value)
value="{{ $value }}" 
@endif
@if ($placeholder)
placeholder="{{ $placeholder }}" 
@endif
@if ($required)
required
@endif
@if ($readonly)
readonly="readonly"
@endif
@if ($onchange)
onchange="{{ $onchange }}" 
@endif
@if ($oninput)
oninput="{{ $oninput }}" 
@endif
/>