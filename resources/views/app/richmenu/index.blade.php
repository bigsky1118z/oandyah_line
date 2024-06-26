<x-frame.web>
    <x-slot name="id">user-app-richmenu-index</x-slot>
    <x-slot name="title">リッチメニュー一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu') }}">リッチメニュー一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <h3>リッチメニュー一覧</h3>
        <div>
            <ul style="display: flex;">
                <li><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/create') }}'">新規作成</button></li>
                <li>
                    <form action="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/update') }}" method="post">
                        @csrf
                        <button type="submit">更新</button>
                    </form>
                </li>
            </ul>
            
        </div>
        <h3></h3>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>width</th>
                    <th>height</th>
                    <th>areas</th>
                    <th colspan="2">status</th>
                    <th colspan="3">button</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($richmenus->sortByDesc("updated_at") as $richmenu)
                    <tr>
                        <td>{{ $richmenu->name              ?? null }}</td>
                        <td>{{ $richmenu->size["width"]     ?? null }}</td>
                        <td>{{ $richmenu->size["height"]    ?? null }}</td>
                        <td>{{ count($richmenu->areas ?? array()) }}</td>
                        <td>{{ $richmenu->status            ?? null }}</td>
                        <td>
                            <ul>
                                @foreach (($richmenu->error ?? array()) as $key => $error)
                                <li>{{ $key }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/'.$richmenu->id) }}'">{{ $richmenu->status=="active" ? "詳細" : "編集" }}</button>
                        </td>
                        <td>
                            @switch($richmenu->status)
                                @case("standby")
                                    <form action="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/'.$richmenu->id.'/upload') }}" method="post">
                                        @csrf
                                        <button type="submit">アップロード</button>
                                    </form>
                                    @break
                                @case("active")
                                    @if ($richmenu->is_default())
                                        <form action="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/default') }}" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit">デフォルト解除</button>
                                        </form>
                                    @else
                                        <form action="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/'.$richmenu->id.'/default') }}" method="post">
                                            @csrf
                                            <button type="submit">デフォルト</button>
                                        </form>
                                    @endif
                                    @break
                                @case("not_found")
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <form action="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/'.$richmenu->id) }}" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit">{{ $richmenu->status == "active" ? "アップロード解除" : "削除" }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-frame.web>