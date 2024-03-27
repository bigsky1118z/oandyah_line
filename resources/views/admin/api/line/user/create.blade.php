@php
    $values =   array();
    
    if(isset($line_api_user)){
        $values = $line_api_user;
    }elseif(!is_null(old())){
        $values = old();
    }
@endphp
<x-admin.api.line.frame.basic title="友達情報" heading="友達情報" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user'">一覧</button></dd>
    @isset($line_api_user_id)
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/{{ $line_api_user_id }}'">詳細</button></dd>
    @endif
</dl>
<section>
    <form action="/api/line/{{ $channel->channel_name }}/user{{ isset($line_api_user_id) ? '/' . $line_api_user_id : null }}" method="post">
        @csrf
        <dl class="dl-flex-left dl-dt-200px">
            <dt>LINE USER ID</dt>
            <dd><input type="text" name="line_user_id" style="width: 19em" @if(isset($values["line_user_id"])) value="{{ $values['line_user_id'] }}" @endif readonly></dd>
            <dd><input type="checkbox" onclick="toggleDisabled(this,'LINE USER IDを変更するとデータが損失する可能性があります。変更しますか？');" checked></dd>
        </dl>        
        <dl class="dl-flex-left dl-dt-200px">
            <dt>管理者識別名</dt>
            <dd><input type="text" name="name_to_identify" @if(isset($values["name_to_identify"])) value="{{ $values['name_to_identify'] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-200px">
            <dt>コミュニティ名</dt>
            <dd><input type="text" name="registed_name" @if(isset($values["registed_name"])) value="{{ $values['registed_name'] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-200px">
            <dt>敬称</dt>
            <dd>
                <input type="text" name="honorific" list="datalist-honorific" @if(isset($values["honorific"])) value="{{ $values['honorific'] }}" @endif>
                <datalist id="datalist-honorific">
                    @foreach (App\Models\Api\LineApiUser::$honorifics as $honorific)
                        <option value="{{ $honorific }}">{{ $honorific }}</option>
                    @endforeach
                </datalist>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-200px">
            <dt>メモ</dt>
            <dd><textarea name="memo">@if(isset($values["memo"])) {{ $values['memo'] }} @endif</textarea></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-200px">
            <dt></dt>
            <dd><button type="submit">作成</button></dd>
        </dl>
    </form>
</section>
<x-slot name="script">
    <script>
        function toggleDisabled(checkbox,text){
            const input =   checkbox.closest("dl").querySelector("input, textarea");
            if(checkbox.checked){
                input.readOnly      =   true;
            } else {
                if(window.confirm(text)){
                    input.readOnly  =   false;
                } else {
                    checkbox.checked    =   true;
                    input.readOnly      =   true;
                }
            }
        }
    </script>
</x-slot>
</x-admin.api.line.frame.basic>