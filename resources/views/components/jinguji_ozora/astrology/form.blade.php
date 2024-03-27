<h3>入力フォーム</h3>
<form action="/jinguji_ozora/astrology" method="post">
    @csrf
    <dl id="dl-forms">
        <dd>
            <dl class="dl-flex-left">
                <dt class="dt-astrology-form-title">生年月日</dt>
                <dd class="dd-astrology-form-value">
                    <dl id="date-of-birth" class="dl-flex-left flex-nowrap">
                        <dd id="date-of-birth-year">
                            <select id="select-date-of-birth-year" name="year">
                                @foreach (range(1900,2100) as $number)
                                    <option value="{{ $number }}" @selected((isset($values["year"]) && $number==$values["year"]) || ((!isset($values["year"]) && $number == "1991")))>{{ str_pad($number, 4, "0", STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                            <span>年</span>
                        </dd>
                        <dd id="date-of-birth-month">
                            <select id="select-date-of-birth-month" name="month">
                                @foreach (range(1,12) as $number)
                                    <option value="{{ $number }}" @selected((isset($values["month"]) && $number == $values["month"]))>{{ str_pad($number, 2, "0", STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                            <span>月</span>
                        </dd>
                        <dd id="date-of-birth-day">
                            <select id="select-date-of-birth-day" name="day">
                                @foreach (range(1,31) as $number)
                                    <option value="{{ $number }}" @selected((isset($values["day"]) && $number == $values["day"]))>{{ str_pad($number, 2, "0", STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                            <span>日</span>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex-left">
                <dt class="dt-astrology-form-title">出生時間</dt>
                <dd class="dd-astrology-form-value">
                    <dl id="time-of-birth" class="dl-flex-left flex-nowrap">
                        <dd id="time-of-birth-hours">
                            <select id="select-time-of-birth-hours" name="hours">
                                @foreach (range(0,23) as $number)
                                    <option value="{{ $number }}" @selected((isset($values["hours"]) && $number==$values["hours"]) || ((!isset($values["hours"]) && $number == 12)))>{{ str_pad($number, 2, "0", STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                            <span>時</span>
                        </dd>
                        <dd id="time-of-birth-minutes">
                            <select id="select-time-of-birth-minutes" name="minutes">
                                @foreach (range(0,59) as $number)
                                    <option value="{{ $number }}"  @selected((isset($values["minutes"]) && $number == $values["minutes"]))>{{ str_pad($number, 2, "0", STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                            <span>分</span>
                        </dd>
                        <dd id="time-of-birth-unknown">
                            <input type="checkbox" id="checkbox-time-of-birth-unknown" onchange="time_of_birth_unknown();">
                            <label for="checkbox-time-of-birth-unknown">不明</label>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex-left">
                <dt class="dt-astrology-form-title">出生地</dt>
                <dd class="dd-astrology-form-value">
                    <select id="select-birth-prefecture" name="prefecture">
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture }}" @selected((isset($values["prefecture"]) && $prefecture==$values["prefecture"]) || ((!isset($values["prefecture"]) && $prefecture == "東京都")))>{{ $prefecture }}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
        </dd>
        {{-- <dd>
            <dl class="dl-flex-left">
                <dt class="dt-astrology-form-title">オプション</dt>
                <dd class="dd-astrology-form-value">
                    <dl class="dl-flex-left dl-astrology-form-option">
                        <dt class="dt-astrology-form-option-title">ホロスコープ</dt>
                        <dd class="dd-astrology-form-option-value">
                        </dd>
                    </dl>
                </dd>
            </dl>
        </dd> --}}
        <dd class="dd-astrology-form-submit">
            <button type="submit">星を導く</button>
        </dd>
    </dl>
</form>
