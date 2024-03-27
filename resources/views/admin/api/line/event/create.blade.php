@php
    $values =   array();
    if(isset($event)){
        $values =   $event;
    }    
@endphp
<x-admin.api.line.frame.basic title="{{ $event_name }} [イベント]" heading="{{ $event_name }} [イベント]" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <h3>{{ isset($event_name) ? $event_name . " " : null }}イベント作成</h3>
    <form action="/api/line/{{ $channel->channel_name }}/event{{ isset($event_name) ? "/" . $event_name : null }}" method="post">
        @csrf
        @if(!isset($event_name))
            <dl class="dl-flex-left dl-dt-120px">
                <dt>タイトル</dt>
                <dd><input type="text" name="event_name" @if(isset($values["event_name"])) value="{{ $values["event_name"] }}" @endif required></dd>
            </dl>
        @endif
        <dl class="dl-flex-left dl-dt-120px">
            <dt>イベント名</dt>
            <dd><input type="text" name="schedule_name" @if(isset($values["schedule_name"])) value="{{ $values["schedule_name"] }}" @endif required></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>概要</dt>
            <dd><textarea name="discription" cols="30" rows="10"> @if(isset($values["discription"])){{ $values["discription"] }}@endif</textarea></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>カテゴリ</dt>
            <dd>
                <input type="text" name="category" @if(isset($values["category"])) value="{{ $values["category"] }}" @endif list="datalist-category">
                <datalist id="datalist-category">
                </datalist>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>サブカテゴリ</dt>
            <dd>
                <input type="text" name="sub_category" @if(isset($values["sub_category"])) value="{{ $values["sub_category"] }}" @endif list="datalist-sub-category">
                <datalist id="datalist-sub-category">
                </datalist>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>ステータス</dt>
            <dd>
                <select name="status" required>
                    <option value="公開" @if(isset($values["status"]) && $values["status"] == "公開") selected @endif>公開</option>
                    <option value="非公開" @if(isset($values["status"]) && $values["status"] == "非公開") selected @endif>非公開</option>
                    <option value="終了" @if(isset($values["status"]) && $values["status"] == "終了") selected @endif>終了</option>
                    <option value="終了（非公開）" @if(isset($values["status"]) && $values["status"] == "終了（非公開）") selected @endif>終了（非公開）</option>
                </select>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>主催</dt>
            <dd><input type="text" name="organizer" @if(isset($values["organizer"])) value="{{ $values["organizer"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>場所</dt>
            <dd><input type="text" name="place" @if(isset($values["place"])) value="{{ $values["place"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>住所</dt>
            <dd><input type="text" name="address" @if(isset($values["address"])) value="{{ $values["address"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>値段</dt>
            <dd><input type="number" name="price" @if(isset($values["price"])) value="{{ $values["price"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>開場</dt>
            <dd><input type="datetime-local" name="open_at" @if(isset($values["open_at"])) value="{{ $values["open_at"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>開演</dt>
            <dd><input type="datetime-local" name="start_at" @if(isset($values["start_at"])) value="{{ $values["start_at"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>終演予定</dt>
            <dd><input type="datetime-local" name="end_at" @if(isset($values["end_at"])) value="{{ $values["end_at"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>閉場</dt>
            <dd><input type="datetime-local" name="close_at" @if(isset($values["close_at"])) value="{{ $values["close_at"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>計上</dt>
            <dd>
                <select name="count">
                    <option value="1" @if(isset($values["count"]) && $values["count"] == 1) selected @endif>計上する</option>
                    <option value="0" @if(isset($values["count"]) && $values["count"] == 0) selected @endif>計上しない</option>
                </select>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt>メンバー</dt>
            <dd>
                @foreach ($user_groups as $user_group)
                    <dl class="dl-flex-left">
                        <dd><input type="checkbox" name="user_groups[]" id="checkbox-user_group-{{ $user_group->id }}" value="{{ $user_group->id }}" @if(isset($values["user_groups"]) && in_array($user_group->id, $values["user_groups"])) checked @endif></dd>
                        <dt><label for="checkbox-user_group-{{ $user_group->id }}">{{ $user_group->name }}</label></dt>
                        <dd><button type="button">ユーザー一覧</button></dd>
                    </dl>
                @endforeach
                <p>選択なしの場合はチャンネル登録者全員が対象になります</p>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-120px">
            <dt></dt>
            <dd><button type="submit">作成</button></dd>
        </dl>
    </form>
</section>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>