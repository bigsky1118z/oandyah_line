<h3>入力フォーム</h3>
<dl id="dl-forms">
    <dd>
        <dl class="dl-flex-left">
            <dt class="dt-numerology-form-title">生年月日</dt>
            <dd class="dd-numerology-form-value">
                <dl id="date-of-birth" class="dl-flex-left flex-nowrap">
                    <dd id="date-of-birth-year">
                        <select id="select-birth-year" name="year" onchange="setBirthdayNumbers();">
                            @foreach (range(1900,2100) as $number)
                                <option value="{{ $number }}" @selected($number == "1991")>{{ str_pad($number, 4, "0", STR_PAD_LEFT) }}</option>
                            @endforeach
                        </select>
                        <span>年</span>
                    </dd>
                    <dd id="date-of-birth-month">
                        <select id="select-birth-month" name="month" onchange="setBirthdayNumbers();">
                            @foreach (range(1,12) as $number)
                                <option value="{{ $number }}">{{ str_pad($number, 2, "0", STR_PAD_LEFT) }}</option>
                            @endforeach
                        </select>
                        <span>月</span>
                    </dd>
                    <dd id="date-of-birth-day">
                        <select id="select-birth-day" name="day" onchange="setBirthdayNumbers();">
                            @foreach (range(1,31) as $number)
                                <option value="{{ $number }}">{{ str_pad($number, 2, "0", STR_PAD_LEFT) }}</option>
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
            <dt class="dt-numerology-form-title">姓名</dt>
            <dd class="dd-numerology-form-value">
                <dl>
                    <dd>姓 <input type="text" id="input-last-name" name="lastName" pattern="^[a-zA-Z]+$" title="半角英字で入力してください" placeholder="ローマ字入力(半角英字)" oninput="setNameNumbers();"></dd>
                    <dd>名 <input type="text" id="input-first-name" name="firstName" pattern="^[a-zA-Z]+$" title="半角英字で入力してください" placeholder="ローマ字入力(半角英字)" oninput="setNameNumbers();"></dd>
                </dl>
            </dd>
        </dl>
    </dd>
    <dd>
        <dl class="dl-flex-left">
            <dt class="dt-numerology-form-title">オプション</dt>
            <dd class="dd-numerology-form-value">
                <dl class="dl-flex-left dl-numerology-form-option">
                    <dt class="dt-numerology-form-option-title">マスターナンバー</dt>
                    <dd class="dd-numerology-form-option-value">
                        <dl class="dl-flex-left">
                            <dd><input type="checkbox" id="checkbox-numerology-master-number-11" name="numerologySystem" value="11" onchange="setBirthdayNumbers(); setNameNumbers();" checked><label for="checkbox-numerology-master-number-11">11</label></dd>
                            <dd><input type="checkbox" id="checkbox-numerology-master-number-22" name="numerologySystem" value="22" onchange="setBirthdayNumbers(); setNameNumbers();" checked><label for="checkbox-numerology-master-number-22">22</label></dd>
                            <dd><input type="checkbox" id="checkbox-numerology-master-number-33" name="numerologySystem" value="33" onchange="setBirthdayNumbers(); setNameNumbers();"><label for="checkbox-numerology-master-number-33">33</label></dd>
                        </dl>
                    </dd>
                </dl>
                <dl class="dl-flex-left dl-numerology-form-option">
                    <dt class="dt-numerology-form-option-title">変換システム</dt>
                    <dd class="dd-numerology-form-option-value">
                        <dl class="dl-flex-left">
                            <dd><input type="radio" id="radio-numerology-system-pythagorean" name="stringSystem" value="pythagorean" onchange="setNameNumbers();" checked><label for="radio-numerology-system-pythagorean">ピュタゴリアン</label></dd>
                            <dd><input type="radio" id="radio-numerology-system-chaldean" name="stringSystem" value="chaldean" onchange="setNameNumbers();"><label for="radio-numerology-system-chaldean">カルディアン</label></dd>
                        </dl>
                    </dd>
                </dl>
            </dd>
        </dl>
    </dd>
</dl>
