<x-frame.admin>
    <x-slot name="id">admin-user-create</x-slot>
    <x-slot name="title">ユーザー</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset('admin' . '/user') }}">ユーザー</a></li>
    </x-slot>
    <x-slot name="main">
        <section>
            <form action="/admin/user/{{ $user->id }}" method="post">
                @csrf
                <h2>ユーザー情報</h2>
                <button type="submit">保存</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>メールアドレス</th>
                            <th>ユーザー名</th>
                            <th>生年月日</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><input type="email" name="email" value="{{ $user->email }}"></td>
                            <td><input type="text" name="name" value="{{ $user->name }}"></td>
                            <td><input type="date" name="birthday" value="{{ $user->birthday }}"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit">保存</button>
                <table>
                    <tbody>
                        <tr>
                            <th>名前</th>
                            <td>
                                <span>姓</span><input type="text" class="name" name="config[last_name]" value="{{ $user->get_config("last_name")->value }}">
                                <span>名</span><input type="text" class="name" name="config[first_name]" value="{{ $user->get_config("first_name")->value }}">
                            </td>
                        </tr>
                        <tr>
                            <th>フリガナ</th>
                            <td>
                                <span>セイ</span><input type="text" class="name" name="config[last_name_kana]" value="{{ $user->get_config("last_name_kana")->value }}">
                                <span>メイ</span><input type="text" class="name" name="config[first_name_kana]" value="{{ $user->get_config("first_name_kana")->value }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit">保存</button>
            </form>
        </section>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-frame.admin>