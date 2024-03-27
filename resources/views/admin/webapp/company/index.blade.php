<x-admin.webapp.frame.basic title="Company" hedding="会社一覧">
<x-slot name="head">
    <style>
        table, p {
            width: 1080px;
            text-align: center;
        }
        table tbody tr td ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }
    </style>
</x-slot>
<form action="/admin/webapp/company" method="get">
    <table>
        <thead>
            <tr>
                <th>code</th>
                <th>name</th>
                <th>tel</th>
                <th>fax</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="code" @isset($query['code']) value="{{ $query['code'] }}" @endisset></td>
                <td><input type="text" name="name" @isset($query['name']) value="{{ $query['name'] }}" @endisset></td>
                <td><input type="text" name="tel" @isset($query['tel']) value="{{ $query['tel'] }}" @endisset></td>
                <td><input type="text" name="fax" @isset($query['fax']) value="{{ $query['fax'] }}" @endisset></td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>pref</th>
                <th>address</th>
                <th>email</th>
                <th>cutoff</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><x-admin.webapp.parts.select.prefecture name="pref" :value="$query['pref'] ?? null" @endisset /></td>
                <td><input type="text" name="address" @isset($query['address']) value="{{ $query['address'] }}" @endisset></td>
                <td><input type="text" name="email" @isset($query['email']) value="{{ $query['email'] }}" @endisset></td>
                <td><input type="text" name="cutoff" @isset($query['cutoff']) value="{{ $query['cutoff'] }}" @endisset></td>
            </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <thead>
                <tr>
                    <th>initial</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><x-admin.webapp.parts.select.initial :value="$query['initial'] ?? null" /></td>
                </tr>
            </tbody>
        </tr>
    </table>
    <p><button type="submit">search</button></p>
</form>

<table>
    <thead>
        <tr>
            <th>code</th>
            <th>name/kana</th>
            <th>tel/fax</th>
            <th>address</th>
            <th>email</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @if($companies->isEmpty())
            <tr>
                <td colspan="6">no companies</td>
            </tr>
        @elseif (!$companies->isEmpty())
            @foreach ($companies as $company)
            <tr>
                <td>{{ $company->code }}</td>
                <td>
                    <ul>
                        <li>{{ $company->name }}</li>
                        <li>{{ $company->kana }}</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>{{ $company->tel }}</li>
                        <li>{{ $company->fax }}</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach ($company->addresses as $address)
                        <li>{{ $address->get_full_address() }}({{ $address->type }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach ($company->emails as $email)
                        <li>{{ $email->email }}({{ $email->type }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><a href="/admin/webapp/company/{{ $company->id }}">detail</a></li>
                        <li><a href="/admin/webapp/company/{{ $company->id }}/edit">edit</a></li>
                    </ul>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6"><a href="/admin/webapp/company/create">add</a></td>
        </tr>
    </tfoot>
</table>
<x-slot name="script">
</x-slot>
</x-admin.webapp.frame.basic>