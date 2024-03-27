<dl @isset($classdl) class="{{ $classdl }}" @endisset>
    <dt>非通知送信</dt>
    <dd>
        <select name="notificationDisabled">
            <option value="notification">通知</option>
            <option value="notificationDisabled">非通知</option>
        </select>
</dl>
