<div id="{{ $id ?? null }}">
    <ul>
        @foreach (($friends ?? array()) as $friend)
            <li>
                <dt><input type="checkbox" value="{{ $friend->friend_id ?? null }}" id="send-to-{{ $friend->id }}"><label for="send-to-{{ $friend->id }}">{{ $friend->get_name() ?? null }}</label></dt>
            </li>
        @endforeach
    </ul>
</div>
