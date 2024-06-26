<x-frame.web>
    <x-slot name="id">user-app-send-show</x-slot>
    <x-slot name="title">送信メッセージ詳細</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/send') }}">送信メッセージ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/send/'.$send->id) }}">{{ $send->id }}</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>送信メッセージ詳細</h3>
            <table>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <ul>
                                <li><button type="submit" name="submit" value="save">保存</button></li>
                                <li><button type="submit" name="submit" value="send">送信</button></li>
                            </ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.web>