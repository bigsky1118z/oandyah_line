@switch($template["type"] ?? null)
    @case("buttons")
        <dl>
            <dt><b>{{ $template["title"] ?? null }}</b></dt>
            <dd>{{ $template["text"] ?? null }}</dd>
            <dd>
                <dl>
                @foreach ($template["actions"] as $action)
                    <dd style="text-align: center; cursor: pointer;">{{ $action["label"] ?? null }}[{{ $action["type"] ?? null }}]</dd>
                @endforeach
                </dl>                    
            </dd>
        </dl>
        @break
    @case(2)
        
        @break
@endswitch
