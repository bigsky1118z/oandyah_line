@switch($object["type"] ?? null)
    @case("text")       <x-web.messages.create.message.text      id="" :index="$index" :object="($object ?? array())" />  @break
    @case("image")      <x-web.messages.create.message.image     id="" :index="$index" :object="($object ?? array())" />  @break
    @case("template")   <x-web.messages.create.message.template  id="" :index="$index" :object="($object ?? array())" />  @break
@endswitch
