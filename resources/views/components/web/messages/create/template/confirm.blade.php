<div id="{{ $id ?? null }}">
    <table class="message-object-template-confirm">
        <tr>
            <td colspan="2" class="message-object-template-border">
                <textarea type="text" class="message-object-template-confirm-text" name="messages[{{ $index ?? 0 }}][template][text]"placeholder="本文" required>{{ $object['template']['text'] ?? null }}</textarea>
            </td>
            <td></td>
        </tr>
        <tr>
            @for ($i = 0; $i < 2; $i++)
                <td>
                    <input type="text" name="messages[{{ $index ?? 0 }}][template][actions][{{ $i ?? 0 }}][label]" value="{{ $object['template']['actions'][$i]['label'] ?? null }}" placeholder="選択肢{{ $i+1 }}">
                </td>
            @endfor
            <td>
                @for ($i = 0; $i < 2; $i++)
                    <ul>
                        <li class="action-type">
                            <x-web.messages.create.action.types
                                parent="ul"
                                area="actions"
                                :index="$index"
                                :choice="$i"
                                :action="($object['template']['actions'][$i] ?? array())"
                            />
                        </li>
                        <li class="action-object">
                            <x-web.messages.create.action.objects
                                id="" 
                                area="actions"
                                :index="$index"
                                :choice="$i"
                                :action="($object['template']['actions'][$i] ?? array())"
                            />
                        </li>
                    </ul>
                @endfor
            </td>
        </tr>        
    </table>
</div>