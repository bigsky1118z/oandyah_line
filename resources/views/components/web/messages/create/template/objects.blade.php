@switch($object["template"]["type"] ?? null)
    @case("buttons")        <x-web.messages.create.template.buttons :index="($index ?? 0)" :object="($object ?? array())" /> @break
    @case("confirm")        <x-web.messages.create.template.confirm :index="($index ?? 0)" :object="($object ?? array())" /> @break
    {{-- @case("carousel")       <x-web.messages.create.template.carousel         :index="($index ?? 0)" :object="($object ?? array())" /> @break --}}
    {{-- @case("image_carousel") <x-web.messages.create.template.image_carousel   :index="($index ?? 0)" :object="($object ?? array())" /> @break --}}
@endswitch
