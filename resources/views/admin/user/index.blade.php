<x-admin.frame.user>
<x-slot name="head">
</x-slot>
<h3>Your Profile</h3>
<table>
    <thead>
        <tr>
            <th>name</th>
            <th>auth</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ auth()->user()->getFullName() }}</td>
            <td>
                @if (auth()->user()->roles()->whereRole("admin")->exists())
                <span>管理者</span>
                @endif
                @if (auth()->user()->roles()->whereRole("staff")->exists())
                <span>従業員</span>
                @endif
                @if (auth()->user()->roles()->whereRole("client")->exists())
                <span>得意先</span>
                @endif

            </td>
        </tr>
    </tbody>
</table>
<h3>Users</h3>
<p><button type="button" onclick="window.location.href = '/admin/user/create';">create new user</button></p>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>PHONE/EMAIL</th>
            <th>LINE</th>
            <th>COMPANY</th>
            <th>AUTH</th>
            <th>EDIT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <td>{{ $user->details->last_name }}</td>
                            <td>{{ $user->details->first_name }}</td>
                        </tr>
                        <tr>
                            <td>{{ $user->details->last_kana }}</td>
                            <td>{{ $user->details->first_kana }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table>
                    <tbody>
                        <tr><td>{{ $user->details->phone }}</td></tr>
                        <tr><td>{{ $user->email }}</td></tr>
                    </tbody>
                </table>
            </td>
            <td>@if($user->details->line) 〇 @endif</td>
            <td>
                <ul>
                    @foreach ($user->companies()->pluck('name') as $company)
                    <li>{{ $company }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                @foreach ($role_names as $role => $name)
                @if ($user->roles()->whereRole($role)->exists())
                <span>{{ $name }}</span>
                @endif
                @endforeach
            </td>
            <td><a href="/admin/user/{{ $user->id }}/edit">EDIT</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-admin.frame.user>