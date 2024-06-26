@switch($template["type"] ?? null)
    @case("buttons")
        <dl class="dl-messages-template-buttons">
            <dt class="dt-messages-template-buttons-title"><b>{{ $template["title"] ?? null }}</b></dt>
            <dd class="dd-messages-template-buttons-text">{{ $template["text"] ?? null }}</dd>
            <dd class="dd-messages-template-buttons-actions">
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
