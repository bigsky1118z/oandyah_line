<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>リッチメニューエイリアスID</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][richMenuAliasId]" value="{{ $action["richMenuAliasId"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>データ</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][data]" value="{{ $action["data"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>
