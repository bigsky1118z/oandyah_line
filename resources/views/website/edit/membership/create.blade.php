@php
    $values =   array();
    if(isset($membership)){
        $values             =   $membership;
        $values["users"]    =   $membership->user_ids();
    }
    if(count(old())) {
        $values =   old();
    }
@endphp
<x-website.frame.edit title="メンバーシップ登録">
<section>
    <h2>メンバーシップ登録</h2>
    <form action="/edit/membership{{ isset($values['id']) ? '/' . $values['id'] : null }}" method="post">
        @csrf
        <dl class="dl-flex-left">
            <dt class="membership-create-title">名前</dt>
            <dd class="membership-create-value required"><input type="text" name="name" @isset($values["name"]) value="{{ $values['name'] }}" @endisset required></dd>
        </dl>
        <dl class="dl-flex-left">
            <dt class="membership-create-title">グレード</dt>
            <dd class="membership-create-value"><input type="text" name="grade" @isset($values["grade"]) value="{{ $values['grade'] }}" @endisset></dd>
        </dl>
        <dl class="dl-flex-left">
            <dt class="membership-create-title">概要</dt>
            <dd class="membership-create-value"><textarea name="discription">@isset($values["discription"])$values['discription'] @endisset </textarea></dd>
        </dl>
        <dl class="dl-flex-left">
            <dt class="membership-create-title">ユーザー</dt>
            <dd class="membership-create-value">
                <dl class="dl-flex-left dl-flex-wrap">
                    @foreach ($users as $user)
                        <dd class="membership-create-checkbox-user">
                            <dl class="dl-flex-left">
                                <dd><input type="checkbox" id="checkbox-user-{{ $user->id }}" name="users[]" value="{{ $user->id }}"  @checked(isset($values["users"]) && in_array($user->id,$values["users"]))></dd>
                                <dd><label for="checkbox-user-{{ $user->id }}">{{ $user->email }}</label></dd>
                            </dl>
                        </dd>
                    @endforeach
                    
                </dl>
            </dd>
        </dl>
        <dl class="dl-flex-left">
            <dt class="membership-create-title"></dt>
            <dd class="membership-create-value"><button type="submit" class="button button-create">保存</button></dd>
        </dl>
    </form>
</section>
<x-slot name="script">
</x-slot>
</x-website.frame.edit>