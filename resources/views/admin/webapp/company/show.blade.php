<x-admin.webapp.frame.basic title="Company" hedding="会社詳細">
    <x-slot name="head">
        <style>
            table ul{
                margin: 0;
                padding: 0;
                list-style: none;
            }
        </style>
    </x-slot>
    <table>
        <tbody>
            <tr>
                <th>code</th>
                <td>{{ $company->code }}</td>
            </tr>
            <tr>
                <th>name</th>
                <td>{{ $company->name }}</td>
            </tr>
            <tr>
                <th>kana</th>
                <td>{{ $company->kana }}</td>
            </tr>
            <tr>
                <th>tel</th>
                <td>{{ $company->tel }}</td>
            </tr>
            <tr>
                <th>fax</th>
                <td>{{ $company->fax }}</td>
            </tr>
            <tr>
                <th>cutoff</th>
                <td>{{ $company->cutoff }}</td>
            </tr>
            <tr>
                <th>collect</th>
                <td>{{ $company->collect }}</td>
            </tr>
            <tr>
                <th>is_write</th>
                <td>{{ $company->is_write }}</td>
            </tr>
            <tr>
                <th>user</th>
                <td>{{ $company->users->count() }}</td>
            </tr>
            <tr>
                <th>address</th>
                <td>
                    <table>
                        <tbody>
                            @foreach ($company->addresses as $address)
                            <tr>
                                <td>{{ $address->type }}</td>
                                <td>{{ $address->zip_code }}</td>
                                <td>{{ $address->prefecture }}</td>
                                <td>{{ $address->city }}</td>
                                <td>{{ $address->street_address }}</td>
                                <td>{{ $address->building_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th>email</th>
                <td>
                    <table>
                        <tbody>
                            @foreach ($company->emails as $email)
                            <tr>
                                <td>{{ $email->type }}</td>
                                <td>{{ $email->email }}</td>
                                <td>{{ $email->name }}</td>
                                <td>{{ $email->user_id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th>provide</th>
                <td>
                    <table>
                        <tbody>
                            @foreach ($company->provides as $provide)
                            <tr>
                                <td>{{ $provide->product->get_display_name() }}</td>
                                <td>{{ $provide->name }}</td>
                                <td>{{ $provide->price }}</td>
                                <td>{{ $provide->status }}</td>
                                <td>{{ $provide->quantity }}～</td>
                                <td>{{ $provide->delivery }}</td>
                                <td>{{ (new DateTime($provide->start_date))->format('Y-m-d') }}</td>
                                @if ($loop->first)
                                    <td rowspan="{{ $loop->count }}"><a href="/admin/webapp/provide" target="_blank" rel="noopener noreferrer">edit(other page)</a></td>                                
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"><a href="/admin/webapp/company/{{ $company->id }}/create">edit</a></td>
            </tr>
        </tfoot>
    </table>
    <x-slot name="script">
    </x-slot>
    </x-admin.webapp.frame.basic>