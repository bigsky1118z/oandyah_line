<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>リンク先</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][uri]" value="{{ $action["uri"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>
