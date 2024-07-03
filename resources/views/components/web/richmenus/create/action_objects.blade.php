@switch($action["type"] ?? null)
    @case("postback")       <x-web.richmenus.create.action_object.postback        id="" :index="$index" :action="($action ?? array())" />  @break
    @case("message")        <x-web.richmenus.create.action_object.message         id="" :index="$index" :action="($action ?? array())" />  @break
    @case("uri")            <x-web.richmenus.create.action_object.uri             id="" :index="$index" :action="($action ?? array())" />  @break
    @case("datetimepicker") <x-web.richmenus.create.action_object.datetimepicker  id="" :index="$index" :action="($action ?? array())" />  @break
    @case("richmenuswitch") <x-web.richmenus.create.action_object.richmenuswitch  id="" :index="$index" :action="($action ?? array())" />  @break
    @case("clipboard")      <x-web.richmenus.create.action_object.clipboard       id="" :index="$index" :action="($action ?? array())" />  @break
@endswitch