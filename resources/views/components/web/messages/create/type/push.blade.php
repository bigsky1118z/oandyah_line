<div id="{{ $id ?? null }}">
    <ul>
        @foreach (($friends ?? array()) as $index => $friend)
            <li>
                <input  type="checkbox" 
                        name="push[]" 
                        value="{{ $friend->friend_id ?? $index }}" 
                        id="message-push-{{ ($friend->id ?? $index) }}"
                        @checked(in_array(($friend->friend_id ?? null),($checked ?? array())))
                >
                <label for="message-push-{{ ($friend->id ?? $index) }}">{{ $friend->get_name() ?? null }}</label>
            </li>
        @endforeach
    </ul>
</div>