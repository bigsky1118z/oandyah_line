@switch($object["template"]["type"] ?? null)
    @case("buttons")        <x-web.messages.create.template_object.buttons          :index="($index ?? 0)" :object="($object ?? array())" /> @break
    {{-- @case("confirm")        <x-web.messages.create.template_object.confirm          :index="($index ?? 0)" :object="($object ?? array())" /> @break --}}
    {{-- @case("carousel")       <x-web.messages.create.template_object.carousel         :index="($index ?? 0)" :object="($object ?? array())" /> @break --}}
    {{-- @case("image_carousel") <x-web.messages.create.template_object.image_carousel   :index="($index ?? 0)" :object="($object ?? array())" /> @break --}}
@endswitch
