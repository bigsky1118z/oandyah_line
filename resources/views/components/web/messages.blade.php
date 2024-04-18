<ul class="ul-messages">
    @foreach ($messages as $message)
        @switch($message["type"])
            @case("text")
                <li class="li-messages-text"><x-web.messages.text :text="$message['text']" /></li>
                @break
            @case("template")                                            
                <li class="li-messages-template"><x-web.messages.template :template="$message['template']" /></li>
                @break
            @default
                @break
        @endswitch
    @endforeach
</ul>
