<x-website.frame.edit>
<x-slot name="title">user</x-slot>
<x-slot name="id">user</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/user">ユーザー詳細</a></x-slot>
<section id="show">
    <h3>アカウント情報</h3>
    <dl id="dl-user-show">
        <dt>
            <dl class="dl-flex dl-user-show-header">
                <dd class="dd-user-show-id">id</dd>
                <dd class="dd-user-show-email">email</dd>
                <dd class="dd-user-show-password">password</dd>
            </dl>
        </dt>
        <dd>
            <dl class="dl-flex dl-user-show-body">
                <dd  class="dd-user-show-id">{{ $user->id }}</dd>
                <dd  class="dd-user-show-email">{{ $user->email }}</dd>
                <dd  class="dd-user-show-password">{{ $user->password ? "**********" : "" }}</dd>
            </dl>
        </dd>
    </dl>
    <h3>ユーザー名</h3>
    <h4>姓名</h4>
    <dl id="dl-user-show-name">
        <dt>
            <dl class="dl-flex dl-user-show-header">
                <dd class="dd-user-show-type"></dd>
                <dd class="dd-user-show-last_name">姓</dd>
                <dd class="dd-user-show-first_name">名</dd>
                <dd class="dd-user-show-middle_name">ミドルネーム</dd>
                <dd class="dd-user-show-maiden_name">旧姓</dd>
            </dl>
        </dt>
        <dd>
            <dl class="dl-flex dl-user-show-body">
                <dd class="dd-user-show-type">名前</dd>
                <dd class="dd-user-show-last_name">{{ isset($user->name) && $user->name->last_name_jp ? $user->name->last_name_jp : "未登録"  }}</dd>
                <dd class="dd-user-show-first_name">{{ isset($user->name) && $user->name->first_name_jp ? $user->name->first_name_jp : "未登録"  }}</dd>
                <dd class="dd-user-show-middle_name">{{ isset($user->name) && $user->name->middle_name_jp ? $user->name->middle_name_jp : "未登録"  }}</dd>
                <dd class="dd-user-show-maiden_name">{{ isset($user->name) && $user->name->maiden_name_jp ? $user->name->maiden_name_jp : "未登録"  }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-user-show-body">
                <dd class="dd-user-show-type">カナ</dd>
                <dd class="dd-user-show-last_name">{{ isset($user->name) && $user->name->last_name_kana ? $user->name->last_name_kana : "未登録"  }}</dd>
                <dd class="dd-user-show-first_name">{{ isset($user->name) && $user->name->first_name_kana ? $user->name->first_name_kana : "未登録"  }}</dd>
                <dd class="dd-user-show-middle_name">{{ isset($user->name) && $user->name->middle_name_kana ? $user->name->middle_name_kana : "未登録"  }}</dd>
                <dd class="dd-user-show-maiden_name">{{ isset($user->name) && $user->name->maiden_name_kana ? $user->name->maiden_name_kana : "未登録"  }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-user-show-body">
                <dd class="dd-user-show-type">name</dd>
                <dd class="dd-user-show-last_name">{{ isset($user->name) && $user->name->last_name_en ? $user->name->last_name_en : "未登録"  }}</dd>
                <dd class="dd-user-show-first_name">{{ isset($user->name) && $user->name->first_name_en ? $user->name->first_name_en : "未登録"  }}</dd>
                <dd class="dd-user-show-middle_name">{{ isset($user->name) && $user->name->middle_name_en ? $user->name->middle_name_en : "未登録"  }}</dd>
                <dd class="dd-user-show-maiden_name">{{ isset($user->name) && $user->name->maiden_name_en ? $user->name->maiden_name_en : "未登録"  }}</dd>
            </dl>
        </dd>
    </dl>
    <h4>その他名前設定</h4>
    <dl id="dl-user-show-name-arrange">
        <dd>
            <dl class="dl-flex">
                <dt>ニックネーム</dt>
                <dd>{{ isset($user->name) && $user->name->nickname ? $user->name->nickname : "未登録" }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>管理用名称</dt>
                <dd>{{ isset($user->name) && $user->name->naming ? $user->name->naming : "未登録" }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>敬称</dt>
                <dd>{{ isset($user->name) && $user->name->honorific_title ? $user->name->honorific_title : "未登録" }}</dd>
            </dl>
        </dd>
    </dl>
    <h3>生年月日</h3>
    <dl id="dl-user-show-birth">
        <dt>
            <dl class="dl-flex dl-user-show-header">
                <dd class="dd-user-show-birth-year">year</dd>
                <dd class="dd-user-show-birth-month">month</dd>
                <dd class="dd-user-show-birth-day">day</dd>
                <dd class="dd-user-show-birth-hours">hours</dd>
                <dd class="dd-user-show-birth-minutes">minutes</dd>
                <dd class="dd-user-show-birth-place">place</dd>
            </dl>
        </dt>
        <dd>
            <dl class="dl-flex dl-user-show-body">
                <dd class="dd-user-show-birth-year">{{ isset($user->birthday) && $user->birthday->year ? $user->birthday->year : "未登録" }}</dd>
                <dd class="dd-user-show-birth-month">{{ isset($user->birthday) && $user->birthday->month ? $user->birthday->month : "未登録" }}</dd>
                <dd class="dd-user-show-birth-day">{{ isset($user->birthday) && $user->birthday->day ? $user->birthday->day : "未登録" }}</dd>
                <dd class="dd-user-show-birth-hours">{{ isset($user->birthday) && $user->birthday->hours ? $user->birthday->hours : "未登録" }}</dd>
                <dd class="dd-user-show-birth-minutes">{{ isset($user->birthday) && $user->birthday->minutes ? $user->birthday->minutes : "未登録" }}</dd>
                <dd class="dd-user-show-birth-place">{{ isset($user->birthday) && $user->birthday->place ? $user->birthday->place : "未登録" }}</dd>
            </dl>
        </dd>
    </dl>
    <h3>登録ページ</h3>
    {{-- <dl id="dl-user-show-category">
        <dt>
            <dl class="dl-flex dl-user-show-header">
                <dd class="dd-user-show-category">category</dd>
                <dd class="dd-user-show-category-role">role</dd>
            </dl>
        </dt>
        @if ($user->categories()->exists())
            @foreach ($user->categories as $category)
                @if ($category->roles()->exists())
                    @foreach ($category->roles as $role)
                    <dd>
                        <dl class="dl-flex dl-user-show-body">
                            <dd class="dd-user-show-category">{{ $category->category  }}</dd>
                            <dd class="dd-user-show-category-role">{{ $role->role }}</dd>
                        </dl>
                    @endforeach
                @else
                    <dd>
                        <dl class="dl-flex dl-user-show-body">
                            <dd class="dd-user-show-category">{{ $category->category  }}</dd>
                            <dd class="dd-user-show-category-role">未設定</dd>
                        </dl>                                    
                    </dd>
                @endif
            @endforeach
        @else
            <dd>
                <dl class="dl-flex dl-user-show-body">
                    <dd class="dd-user-show-category">未設定</dd>
                    <dd class="dd-user-show-category-role">未設定</dd>
                </dl>
            </dd>
        @endif
    </dl> --}}
    <dl id="dl-user-show-subdirectory_role">
        <dt>
            <dl class="dl-flex dl-user-show-header">
                <dd class="dd-user-show-subdirectory_role-subdirectory">subdirectory</dd>
                <dd class="dd-user-show-subdirectory_role-role">role</dd>
            </dl>
        </dt>
        @foreach ($subdirectories as $subdirectory)
        <dd>
            <dl class="dl-flex dl-user-show-body">
                <dd class="dd-user-show-subdirectory_role-subdirectory">{{ $subdirectory->value }}</dd>
                <dd class="dd-user-show-subdirectory_role-role">
                    <dl class="dl-flex">
                        @if ($user->subdirectory_roles($subdirectory->value)->count())
                            @foreach ($user->subdirectory_roles($subdirectory->value) as $subdirectory_role)
                                <dd>{{ $subdirectory_role->role->value }}</dd>
                            @endforeach
                        @else
                            <dd>未登録</dd>
                        @endif
                    </dl>
                </dd>
            </dl>
        </dd>
        @endforeach
    </dl>
    <h3>操作</h3>
    <dl class="dl-flex">
        <dd><button type="button" onclick="location.href = '/edit/user/{{ $user->id }}/edit'">編集</button></dd>
        <dd><button type="button" onclick="location.href = '/edit/user/{{ $user->id }}/delete'">削除</button></dd>
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
</x-website.frame.edit>