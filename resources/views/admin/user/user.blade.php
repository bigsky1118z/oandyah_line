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
@switch($resource)
@case('index')
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
    @break
@case('show')
    @break;
@case('edit')
@case('create')
    @php
        if ($errors->any()) {
            $values =  array(
                'user'      =>  old('user'),
                'id'        =>  old('id'),
                'details'   =>  old('details'),
                'roles'     =>  old('roles'),
                'companies' =>  old('companies'),
            );
            if($resource == "create"){
            }
        } elseif (isset($user)){
            $values =  array(
                'user'      =>  $user,
                'id'        =>  $user->id,
                'details'    =>  $user->details,
                'roles'     =>  array(),
                'companies' =>  array(),
            );
            foreach ($user->companies as $company) {
                array_push($values['companies'],$company->id);
            }
            foreach ($user->roles as $role) {
                $values['roles'][$role['role']] = "on";
            }
        } elseif (!isset($user)) {
            $values = array(
                'user'      =>  array(
                    'email'         =>  null,
                    'password'      =>  null,
                ),
                'id'        =>  null,
                'details'    =>  array(
                    'last_name'     =>  null,
                    'first_name'    =>  null,
                    'last_kana'     =>  null,
                    'first_kana'    =>  null,
                    'phone'         =>  null,
                    'line'          =>  null,
                ),
                'roles'     =>  array(),
                'companies' =>  array(),
            );
        }
    @endphp
    @if ($resource == 'edit')
        <h3>ユーザー情報編集</h3>
        <form action="/admin/user/{{ $user->id }}" method="post">
        @method('put')
    @elseif ($resource == 'create')
        <h3>ユーザー情報作成</h3>
        <form action="/admin/user" method="post">
    @endif
        @csrf
        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
        @endif
        <table>
            <tbody>
                @if ($resource == 'create')
                <tr>
                    <th>メール</th>
                    <td><input type="email" name="user[email]" value="{{ $values['user']['email'] }}"></td>
                </tr>
                <tr>
                    <th>パスワード</th>
                    <td><input type="password" name="user[password]" value="{{ $values['user']['password'] }}"></td>
                </tr>
                @endif
                <tr>
                    <th>名前</th>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                    <th>姓</th>
                                    <th>名</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="details[last_name]" value="{{ $values['details']['last_name'] }}"></td>
                                    <td><input type="text" name="details[first_name]" value="{{ $values['details']['first_name'] }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>カナ</th>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                    <th>セイ</th>
                                    <th>メイ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="details[last_kana]" value="{{ $values['details']['last_kana'] }}"></td>
                                    <td><input type="text" name="details[first_kana]" value="{{ $values['details']['first_kana'] }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>電話</th>
                    <td><input type="text" name="details[phone]" value="{{ $values['details']['phone'] }}"></td>
                </tr>
                <tr>
                    <th>LINE</th>
                    <td><input type="text" name="details[line]" value="{{ $values['details']['line'] }}"></td>
                </tr>
                <tr>
                    <th>会社</th>
                    <td>
                        <table>
                            <tbody>
                                @if ($values['companies'])
                                    @foreach ($values['companies'] as $company_id)
                                    <tr>
                                        <td><x-admin.parts.select.user-company name="companies[]" :value="$company_id" :items="$companies" /></td>
                                        <td><button type="button" onclick="buttonThreadDeleteToTheLast(this)">×</button></td>
                                    </tr>                                    
                                    @endforeach
                                @elseif(!$values['companies'])
                                    <tr>
                                        <td><x-admin.parts.select.user-company name="companies[]" :items="$companies" /></td>
                                        <td><button type="button" onclick="buttonThreadDeleteToTheLast(this)">×</button></td>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><button type="button" onclick="addNewCompanies(this);">add new company</button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>権限</th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <th>得意先</th>
                                    <td><input type="checkbox" name="roles[client]" @if (isset($values['roles']['client'])) checked @endif></td>
                                </tr>
                                <tr>
                                    <th>従業員</th>
                                    <td><input type="checkbox" name="roles[staff]" @if (isset($values['roles']['staff'])) checked @endif></td>
                                </tr>
                                <tr>
                                    <th>管理者</th>
                                    <td><input type="checkbox" name="roles[admin]" @if (isset($values['roles']['admin'])) checked @endif></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <p><input type="submit" onclick="window.onbeforeunload=null;" value="{{ $resource }}"></p>
    </form>
    @if ($resource == "edit")
    <h3>ユーザー削除</h3>
    <form action="/admin/user/{{ $user->id }}" method="post">
    @method('delete')
    @csrf
    <p><input type="submit" onclick="window.onbeforeunload=null;" value="delete"></p>
    </form> 
    @endif
    <div style="display:none;">
        <x-admin.parts.select.user-company id="sumple-company" :items="$companies" />
    </div>
    <x-slot name="script">
        <x-.admin.parts.script.button />
        <x-.admin.parts.script.onbeforeunload />
        <script>
            function addNewCompanies(param) {
                const tbody     = param.closest('table').querySelector('tbody');
                const tr        = document.createElement('tr');
                const company   = document.getElementById('sumple-company').cloneNode(true);
                company.removeAttribute('id');
                company.setAttribute('name','companies[]');
                const button = document.createElement('button');
                button.textContent = '×';
                button.setAttribute('type','button');
                button.setAttribute('onclick','buttonThreadDeleteToTheLast(this);');
                [company, button].forEach(item => {
                    const td = document.createElement('td');
                    if(item){
                        td.appendChild(item);
                    }
                    tr.appendChild(td);
                });
                tbody.appendChild(tr);
            }
        </script>
    </x-slot>
    @break
@default        
@endswitch
</x-admin.frame.user>