<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>モード</dt>
                <dd>
                    <select name="areas[{{ $index ?? 0 }}][action][mode]">
                        <option value="date" @selected("date" == ($action["mode"] ?? null))>日付を選択</option>
                        {{-- <option value="time" @selected("time" == ($action["mode"] ?? null))>時刻を選択</option>
                        <option value="datetime" @selected("datetime" == ($action["mode"] ?? null))>日付と日時を選択</option> --}}
                    </select>
                </dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>初期値</dt>
                <dd><input type="date" name="areas[{{ $index ?? 0 }}][action][initial]" value="{{ $action["initial"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>最小値</dt>
                <dd><input type="date" name="areas[{{ $index ?? 0 }}][action][min]" value="{{ $action["min"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>最大値</dt>
                <dd><input type="date" name="areas[{{ $index ?? 0 }}][action][max]" value="{{ $action["max"] ?? null }}"></dd>
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
