<x-frame.web>
    <x-slot name="id">user-app-message-show</x-slot>
    <x-slot name="title">送信メッセージ詳細</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/message') }}">送信メッセージ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/message/'.$message->id) }}">{{ $message->name }}</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>送信メッセージ詳細</h3>
            <table>
                <tbody>
                    <tr>
                        <th>送信方法</th>
                        <td>{{ $message->get_type() ?? null }}</td>
                    </tr>
                    <tr>
                        <th>送信結果</th>
                        <td>
                            <dl>
                                <dd>送信数 : {{ $message->sends->count() }}</dd>
                                <dd>成功 : {{ $message->sends->where("response_code",200)->count() }}</dd>
                                <dd>失敗 : {{ $message->sends->where("response_code","!=",200)->count() }}</dd>
                            </dl>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section>
            <h3>送信結果</h3>
            <table>
                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($message->sends as $send)
                        <tr>
                            <td>{{ $send->datetime ?? null }}</td>
                            <td>{{ $send->get_friend()->get_name()  ?? null }}</td>
                            <td>{{ $send->response_code ?? null }}</td>
                            <td>{{ $send->response_code == 200 ? null : ($send->error_message ?? null) }}</td>
                            <td></td>
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