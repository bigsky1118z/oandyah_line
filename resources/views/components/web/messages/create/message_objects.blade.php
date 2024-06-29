@switch($object["type"] ?? null)
    @case("text")   <x-web.messages.create.message_object.text  id="" :index="$index" :object="($object ?? array())" />  @break
    @case("image")  <x-web.messages.create.message_object.image id="" :index="$index" :object="($object ?? array())" />  @break
@endswitch
