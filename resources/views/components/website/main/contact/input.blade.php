@switch($form->name)
    @case("age")
        <input type="{{ $form->type }}" name="{{ $form->name }}" min="0" max="999" {{ $form->required ? "required placeholder=必須" : null }}>
        @break
    @case("message")
    @case("impression")
        <textarea name="{{ $form->name }}"{{ $form->required ? "required placeholder=必須" : null }}></textarea>
        @break
    @case("email")
    @case("name")
    @case("nickname")
    @case("address")
    @case("agreement")
    @default
        <input type="{{ $form->type }}" name="{{ $form->name }}"{{ $form->required ? "required placeholder=必須" : null }}>
@endswitch