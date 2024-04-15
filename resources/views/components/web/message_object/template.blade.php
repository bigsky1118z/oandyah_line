@switch($template["type"] ?? null)
    @case("buttons")
        <dl>
            <dt>{{ $template["title"] ?? null }}</dt>
            <dd>{{ $template["text"] ?? null }}</dd>
            <dd>
                <dl>
                @foreach ($template["actions"] as $action)
                    <dd>{{ $action["label"] ?? null }}[{{ $action["type"] ?? null }}]</dd>
                @endforeach
                </dl>                    
            </dd>
        </dl>
        @break
    @case(2)
        
        @break
@endswitch
