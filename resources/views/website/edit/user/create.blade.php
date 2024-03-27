<x-website.frame.edit>
@php
    $values =   array();
    if(isset($user)){
        $values =   $user;
        if($user->name){
            $names  =   array("last_name_jp","last_name_kana","last_name_en","middle_name_jp","middle_name_kana","middle_name_en","first_name_jp","first_name_kana","first_name_en","maiden_name_jp","maiden_name_kana","maiden_name_en","nickname","naming","honorific_title");
            foreach ($names as $name) {
                $values["name_" . $name]  =   $user->name[$name];
            }
        }
        if($user->birthday){
            $birthdays = array("year","month","day","hours","minutes","place");
            foreach ($birthdays as $birthday) {
                $values["birth_" . $birthday]  =   $user->birthday[$birthday];
            }
        }
        if($user->subdirectory_roles){
            $subdirectory_roles =   array();
            foreach ($subdirectories as $subdirectory) {
                $subdirectory_value =   $subdirectory->value;
                $roles_array        =   array();
                if($user->subdirectory_roles($subdirectory_value)->count()){
                    foreach ($user->subdirectory_roles($subdirectory_value) as $subdirectory_role) {
                        $roles_array[]  =   isset($subdirectory_role->role) ? $subdirectory_role->role->value : null;
                    }
                }
                $subdirectory_roles[$subdirectory_value]    =   $roles_array;
                // $values["subdirectory_" . $subdirectory_value]  =   $roles_array;
            }
            $values["subdirectory_roles"]   =   $subdirectory_roles;

        }
    }
    if(count(old())) {
        $values =   old();
    }
@endphp
<x-slot name="title">user</x-slot>
<x-slot name="id">user</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/user">ユーザー詳細</a></x-slot>
<section id="create">
    <form action="/edit/user{{ isset($values['id']) && $values['id'] ? '/' . $values["id"] : null }}" method="post">
        @csrf
        <h3>アカウント情報</h3>
        <dl id="dl-user-create">
            <dt>
                <dl class="dl-flex dl-user-create-header">
                    <dd class="dd-user-create-id">id</dd>
                    <dd class="dd-user-create-email">email</dd>
                    <dd class="dd-user-create-password">password</dd>
                </dl>
            </dt>
            <dd>
                <dl class="dl-flex dl-user-create-body">
                    @if (!isset($values["id"]))
                        <dd class="dd-user-create-id">new</dd>
                        <dd class="dd-user-create-email"><input type="email" name="email" required></dd>
                        <dd class="dd-user-create-password"><input type="password" name="password" required></dd>
                    @elseif (auth()->user()->is_admin())
                        <dd class="dd-user-create-id">{{ isset($values["id"]) ? $values["id"] : null }}</dd>
                        <dd class="dd-user-create-email"><input type="email" name="email" value="{{ isset($values['email']) ? $values['email'] : null }}" required></dd>
                        <dd class="dd-user-create-password">**********</dd>
                    @else
                        <dd class="dd-user-create-id">{{ isset($values["id"]) ? $values["id"] : null }}</dd>
                        <dd class="dd-user-create-email">{{ isset($values["email"]) ? $values["email"] : null }}</dd>
                        <dd class="dd-user-create-password">**********</dd>
                    @endif
                </dl>
            </dd>
        </dl>
        <h3>ユーザー名</h3>
        <h4>姓名</h4>
        <dl id="dl-user-create-name">
            <dt>
                <dl class="dl-flex dl-user-create-header">
                    <dd class="dd-user-create-type"></dd>
                    <dd class="dd-user-create-last_name">姓</dd>
                    <dd class="dd-user-create-first_name">名</dd>
                    <dd class="dd-user-create-middle_name">ミドルネーム</dd>
                    <dd class="dd-user-create-maiden_name">旧姓</dd>
                </dl>
            </dt>
            <dd>
                <dl class="dl-flex dl-user-create-body">
                    <dd class="dd-user-create-type">名前</dd>
                    <dd class="dd-user-create-last_name"><input type="text" name="name_last_name_jp" value="{{ isset($values["name_last_name_jp"]) ? $values["name_last_name_jp"] : null }}"></dd>
                    <dd class="dd-user-create-first_name"><input type="text" name="name_first_name_jp" value="{{ isset($values["name_first_name_jp"]) ? $values["name_first_name_jp"] : null }}"></dd>
                    <dd class="dd-user-create-middle_name"><input type="text" name="name_middle_name_jp" value="{{ isset($values["name_middle_name_jp"]) ? $values["name_middle_name_jp"] : null }}"></dd>
                    <dd class="dd-user-create-maiden_name"><input type="text" name="name_maiden_name_jp" value="{{ isset($values["name_maiden_name_jp"]) ? $values["name_maiden_name_jp"] : null }}"></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-user-create-body">
                    <dd class="dd-user-create-type">カナ</dd>
                    <dd class="dd-user-create-last_name"><input type="text" name="name_last_name_kana" value="{{ isset($values["name_last_name_kana"]) ? $values["name_last_name_kana"] : null }}"></dd>
                    <dd class="dd-user-create-first_name"><input type="text" name="name_first_name_kana" value="{{ isset($values["name_first_name_kana"]) ? $values["name_first_name_kana"] : null }}"></dd>
                    <dd class="dd-user-create-middle_name"><input type="text" name="name_middle_name_kana" value="{{ isset($values["name_middle_name_kana"]) ? $values["name_middle_name_kana"] : null }}"></dd>
                    <dd class="dd-user-create-maiden_name"><input type="text" name="name_maiden_name_kana" value="{{ isset($values["name_maiden_name_kana"]) ? $values["name_maiden_name_kana"] : null }}"></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-user-create-body">
                    <dd class="dd-user-create-type">name</dd>
                    <dd class="dd-user-create-last_name"><input type="text" name="name_last_name_en" value="{{ isset($values["name_last_name_en"]) ? $values["name_last_name_en"] : null }}"></dd>
                    <dd class="dd-user-create-first_name"><input type="text" name="name_first_name_en" value="{{ isset($values["name_first_name_en"]) ? $values["name_first_name_en"] : null }}"></dd>
                    <dd class="dd-user-create-middle_name"><input type="text" name="name_middle_name_en" value="{{ isset($values["name_middle_name_en"]) ? $values["name_middle_name_en"] : null }}"></dd>
                    <dd class="dd-user-create-maiden_name"><input type="text" name="name_maiden_name_en" value="{{ isset($values["name_maiden_name_en"]) ? $values["name_maiden_name_en"] : null }}"></dd>
                </dl>
            </dd>
        </dl>
        <h4>その他名前設定</h4>
        <dl id="dl-user-create-name-arrange">
            <dd>
                <dl class="dl-flex">
                    <dt>ニックネーム</dt>
                    <dd><input type="text" name="name_nickname" value="{{ isset($values['name_nickname']) ? $values['name_nickname'] : null }}"></dd>
                </dl>
                <dl class="dl-flex">
                    <dt>管理用名称</dt>
                    <dd><input type="text" name="name_naming" value="{{ isset($values['name_naming']) ? $values['name_naming'] : null }}"></dd>
                </dl>
                <dl class="dl-flex">
                    <dt>敬称</dt>
                    <dd><input type="text" name="name_honorific_title" value="{{ isset($values['name_honorific_title']) ? $values['name_honorific_title'] : null }}"></dd>
                </dl>
            </dd>
        </dl>
        <h3>生年月日</h3>
        <dl id="dl-user-create-birth">
            <dt>
                <dl class="dl-flex dl-user-create-header">
                    <dd class="dd-user-create-birth-year">year</dd>
                    <dd class="dd-user-create-birth-month">month</dd>
                    <dd class="dd-user-create-birth-day">day</dd>
                    <dd class="dd-user-create-birth-hours">hours</dd>
                    <dd class="dd-user-create-birth-minutes">minutes</dd>
                    <dd class="dd-user-create-birth-place">place</dd>
                </dl>
            </dt>
            <dd>
                <dl class="dl-flex dl-user-create-body">
                    <dd class="dd-user-create-birth-year"><input type="number" name="birth_year" min="1900" max="2100" value="{{ isset($values['birth_year']) ? $values['birth_year'] : null }}"></dd>
                    <dd class="dd-user-create-birth-month"><input type="number" name="birth_month" min="1" max="11" value="{{ isset($values['birth_month']) ? $values['birth_month'] : null }}"></dd>
                    <dd class="dd-user-create-birth-day"><input type="number" name="birth_day" min="1" max="31" value="{{ isset($values['birth_day']) ? $values['birth_day'] : null }}"></dd>
                    <dd class="dd-user-create-birth-hours"><input type="number" name="birth_hours" min="0" max="23" value="{{ isset($values['birth_hours']) ? $values['birth_hours'] : null }}"></dd>
                    <dd class="dd-user-create-birth-minutes"><input type="number" name="birth_minutes" min="0" max="59" value="{{ isset($values['birth_minutes']) ? $values['birth_minutes'] : null }}"></dd>
                    <dd class="dd-user-create-birth-place"><input type="text" name="birth_place" value="{{ isset($values['birth_place']) ? $values['birth_place'] : null }}"></dd>
                </dl>
            </dd>
        </dl>
        <h3>登録ページ</h3>
        <dl id="dl-user-create-subdirectory_role">
            <dt>
                <dl class="dl-flex dl-user-create-header">
                    <dd class="dd-user-create-subdirectory_role-subdirectory">subdirectory</dd>
                    <dd class="dd-user-create-subdirectory_role-role">role</dd>
                </dl>
            </dt>
            @foreach ($subdirectories as $subdirectory)
                <dd>
                    <dl class="dl-flex dl-user-create-body">
                        <dd class="dd-user-create-subdirectory_role-subdirectory">{{ $subdirectory->value }}</dd>
                        <dd class="dd-user-create-subdirectory_role-role">
                            <dl class="dl-flex">
                                @foreach ($subdirectory->roles as $role)
                                    <dd>
                                        <input type="checkbox" id="{{ $subdirectory->value }}_{{ $role->role->value }}" name="subdirectory_roles[{{ $subdirectory->value }}][]" value="{{ $role->role->value }}" @checked(isset($values["subdirectory_roles"][$subdirectory->value]) && in_array($role->role->value, $values["subdirectory_roles"][$subdirectory->value]))>
                                        <label for="{{ $subdirectory->value }}_{{ $role->role->value }}">{{ $role->role->value }}</label>
                                    </dd>
                                @endforeach
                            </dl>
                        </dd>
                    </dl>
                </dd>
            @endforeach
        </dl>
        <h3>操作</h3>
        <dl class="dl-flex">
            <dd><button type="submit">保存</button></dd>
        </dl>
    </form>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
</x-website.frame.edit>