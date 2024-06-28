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
            <table>
                <thead>
                    <tr>
                        <th>name</th>
                        <th>type</th>
                        <th>keyword</th>
                        <th>status</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach ($app->replies as $reply)
                        <tr>
                            <td>{{ $reply->name ?? null }}</td>
                            <td>{{ $reply->type ?? null }}</td>
                            <td>{{ $reply->get_match() ?? null }}</td>
                            <td>{{ implode(",",($reply->keyword ?? array())) }}</td>
                            <td>{{ $reply->get_status() ?? null }}</td> 
                            <td>{{ $reply->messages->where("status","active")->count() ?? null }}</td>
                            <td>
                                <button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/reply/'.$reply->id) }}'">詳細</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.web>