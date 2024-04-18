<ul class="ul-messages">
    @foreach ($messages as $message)
        @switch($message["type"])
            @case("text")
                <li><x-web.messages.text :text="$message['text']" /></li>
                @break
            @case("template")                                            
                <li><x-web.messages.template :template="$message['template']" /></li>
                @break
            @default
                @break
        @endswitch
    @endforeach
</ul>
