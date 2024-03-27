<dl @isset($classdl) class="{{ $classdl }}" @endisset>
    <dt>送信日時</dt>
    <dd class="select-dd">
        <dl>
            <dt>
                <input type="radio" id="schedule-type-realtime" name="schedule[type]" value="realtime" onchange="selectSchedule(this);" checked required>
                <label for="schedule-type-realtime">リアルタイム送信</label>
            </dt>
            <dt>
                <input type="radio" id="schedule-type-draft" name="schedule[type]" value="draft" onchange="selectSchedule(this);">
                <label for="schedule-type-draft">下書き</label>
            </dt>
            <dt>
                <input type="radio" id="schedule-type-reserve" name="schedule[type]" value="reserve" onchange="selectSchedule(this);">
                <label for="schedule-type-reserve">時間指定</label>
                <input type="datetime-local" name="schedule[datetime]" class="addReserve" min="{{ str_replace(" ","T",(new DateTime())->modify('+30 minutes')->format('Y-m-d H:i')) }}" disabled>
            </dt>
        </dl>
    </dd>
    <dd class="content-dd"></dd>
</dl>