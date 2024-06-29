<div>
    <ul>
        @foreach (($objects ?? array()) as $object)
            <li>
                @switch(($object["type"] ?? null))
                    @case("text")
                        <x-web.messages.show.message_object.text :object="$object ?? array()" />
                        @break
                    @case("image")
                        <x-web.messages.show.message_object.image :object="$object ?? array()" />
                        @break
                @endswitch
            </li>
        @endforeach
    </ul>
</div>
