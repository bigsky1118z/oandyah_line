<ul class="ul-messages">
    @foreach ($messages as $message)
        @switch($message["type"])
            @case("text")
                <li><x-web.message_object.text :text="$message['text']" /></li>
                @break
            @case("template")                                            
                <li><x-web.message_object.template :template="$message['template']" /></li>
                @break
            @default
                @break
        @endswitch
    @endforeach
</ul>
<style>
    ul.ul-messages > li {
        border: 1px solid #000000;
        border-radius: 10px;
        background-color: greenyellow;
        padding: 5px;
    }
</style>
