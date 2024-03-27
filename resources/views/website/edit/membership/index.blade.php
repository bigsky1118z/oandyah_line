<x-website.frame.edit title="メンバーシップ一覧">
<section>
    <dl>
        <dd><a href="/edit" class="button button-create">編集TOP</a></dd>
    </dl>
</section>
<section>
    <h2>メンバーシップ一覧</h2>
    <dl>
        <dd>
            <dl class="dl-flex-left dl-dt-header">
                <dt class="membership-name">name</dt>
                <dt class="membership-grade">grade</dt>
                <dt class="membership-discription">discription</dt>
                <dt class="membership-users">users</dt>
                <dt class="membership-buttons">buttons</dt>
            </dl>
        </dd>
        @if ($memberships->isNotEmpty())
            @foreach ($memberships as $membership)
                <dd>
                    <dl class="dl-flex-left">
                        <dd class="membership-name">{{ $membership->name }}</dd>
                        <dd class="membership-grade">{{ $membership->grade ? $membership->grade : "---" }}</dd>
                        <dd class="membership-discription">{{ $membership->discription ? $membership->discription : "---" }}</dd>
                        <dd class="membership-users">{{ $membership->users->count() }}</dd>
                        <dd class="membership-buttons">
                            @if ($membership->name != "ユーザー登録")
                                <a href="/edit/membership/{{ $membership->id }}" class="button button-edit">管理</a>
                                <a href="/edit/membership/{{ $membership->id }}/delete" class="button button-delete">削除</a>                            
                            @endif
                        </dd>
                    </dl>
                </dd>
            @endforeach
        @else
            <dd>現在登録されているメンバーシップはありません</dd>
        @endif
        <dd>
            <dl class="dl-flex-left">
                <dd class="membership-name">---</dd>
                <dd class="membership-grade">---</dd>
                <dd class="membership-discription">---</dd>
                <dd class="membership-users">---</dd>
                <dd class="membership-buttons">
                    <a href="/edit/membership/create" class="button button-create">新規作成</a>
                </dd>
            </dl>
        </dd>
    </dl>
</section>
            {{-- <h3>{{ $title }}</h3>
            <dl>
                <dd>
                    <dl class="dl-flex-left dl-dt-header">
                        <dt class="page-name">パス</dt>
                        <dt class="page-title">タイトル</dt>
                        @switch($category)
                            @case("multiple")
                                <dt class="page-extra">記事数</dt>                            
                                @break
                            @case("menu")
                                <dt class="page-extra">登録数</dt>                            
                                @break
                            @case("single")
                            @case("contact")
                            @case("image")
                            @default
                                <dt class="page-extra">---</dt>                        
                                @break
                        @endswitch
                        <dt class="page-status">status</dt>
                        <dt class="page-valid_expired">valid-expired</dt>
                        <dt class="page-buttons">操作</dt>
                    </dl>
                </dd>
                @if(isset($pages[$category]))        
                    @foreach ($pages[$category] as $page)
                        <dd>
                            <dl class="dl-flex-left">
                                <dd class="page-name">{{ $page->name }}</dd>
                                <dd class="page-title"><a href="/{{ $page->name }}" target="_blank" rel="noopener noreferrer">{{ $page->title }}</a></dd>
                                @switch($category)
                                    @case("multiple")
                                        <dd class="page-extra">{{ $page->multiples->count() }}</dd>
                                        @break
                                    @case("menu")
                                        <dd class="page-extra">{{ $page->menus->count() }}</dd>                            
                                        @break
                                    @case("single")
                                    @case("contact")
                                    @case("image")
                                    @default
                                        <dd class="page-extra"></dd>
                                        @break
                                @endswitch
                                <dd class="page-status">{{ isset($statuses[$page->status]) ? $statuses[$page->status] : "---" }}</dd>
                                <dd class="page-valid_expired">
                                    <ul>
                                        <li>{{ $page->valid_at }}</li>
                                        <li>{{ $page->expired_at ? $page->expired_at : "---" }}</li>
                                    </ul>                                
                                </dd>
                                @if ($category != "sub_directory")
                                    <dd class="page-buttons">
                                        <a class="button button-edit" href="/edit/page/{{ $category }}/{{ $page->id }}">設定</a>
                                        <a class="button button-edit" href="/edit/{{ $category }}/{{ $page->id }}">編集</a>
                                        <a class="button button-delete" href="/edit/page/{{ $category }}/{{ $page->id }}/delete">削除</a>
                                    </dd>
                                @endif
                            </dl>
                        </dd>
                    @endforeach
                @else
                    <dd>現在、作成されているメンバーシップはありません</dd>
                @endif
                @if ($category != "sub_directory")
                    <dd>
                        <dl class="dl-flex-left">
                            <dd class="page-name">---</dd>
                            <dd class="page-title">---</dd>
                            <dd class="page-extra">---</dd>
                            <dd class="page-status">---</dd>
                            <dd class="page-valid_expired">---</dd>
                            <dd class="page-buttons"><a class="button button-create" href="/edit/page/{{ $category }}/create">新規作成</a></dd>
                        </dl>
                    </dd>
                @endif
            </dl>
        </section>
    @endforeach --}}
</x-website.frame.edit>