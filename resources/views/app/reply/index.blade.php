<x-frame.web>
    <x-slot name="id">user-app-reply-index</x-slot>
    <x-slot name="title">自動返信一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/reply') }}">自動返信一覧</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>自動返信一覧</h3>
            <ul>
                @foreach ($types as $key => $value)
                    <li><input type="checkbox" id="categogy-{{ $key }}"><label for="categogy-{{ $key }}">{{ $value }}</label></li> 
                @endforeach
            </ul>
            <ul>
                <li><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/reply/create') }}'">作成</button></li>
            </ul>
            <table>
                @foreach ($categories as $category => $category_title)
                    <thead>
                        <tr>
                            <th colspan="6"><h4>{{ $category_title }}</h4></th>
                        </tr>
                        <tr>
                            <th>タイトル</th>
                            <th>タイプ</th>
                            <th>検索条件</th>
                            <th>状態</th>
                            <th>メッセージ数</th>
                            <th>操作</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach (($app->replies->groupBy("category")[$category] ?? array()) as $reply)
                            <tr data-type="{{ $reply->type ?? null }}">
                                <td>{{ $reply->get_type() ?? null }}</td>
                                <td>{{ $reply->name ?? null }}</td>
                                <td>
                                    <ul>
                                        @foreach ($reply->get_queries() as $key => $value)
                                            <li>{{ $key }} : {{ mb_strimwidth($value,0,20,"...") }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $reply->get_status() ?? null }}</td> 
                                <td>{{ $reply->messages->where("status","active")->count() ?? null }}</td>
                                <td>
                                    <button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/reply/'.$reply->id) }}'">編集</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endforeach
            </table>
        </section>
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.web>