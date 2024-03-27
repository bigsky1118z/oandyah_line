<x-admin.webapp.frame.basic title="{{ $resource }} Company">
@php
    $values =   array();
    $keys   =   array(
        'id',
        'code',
        'name',
        'kana',
        'tel',
        'fax',
        'cutoff',
        'collect',
        'is_write',
        'addresses',
        'emails',
        'provides',
    );
    if ($errors->any()) {
        foreach ($keys as $key) {
            $values[$key]   =   old($key);
        }
    } elseif (isset($company)){
        foreach ($keys as $key) {
            $values[$key]   =   $company[$key];
        }
    } elseif (!isset($company)) {
        foreach ($keys as $key) {
            if(in_array($key, array("addresses", "emails", "provides",))){
                $values[$key]   =   array();
            }else{
                $values[$key]   =   null;
            }
        }
    }
@endphp
<x-slot name="head">
    <style>
        table ul{
            margin: 0;
            padding: 0;
            list-style: none;
        }
    </style>
</x-slot>
<h3>{{ $resource }}</h3>
@if ($resource == "create")
    <x-slot name="heading">会社情報追加</x-slot>
    <form action="/admin/webapp/company" method="post">
@elseif($resource == "edit")
    <x-slot name="heading">会社情報編集</x-slot>
    <form action="/admin/webapp/company/{{ $values['id'] }}" method="post">
    @method('put')
@endif
    @csrf
    <table>
        <tbody>
            <tr>
                <th>code</th>
                <td><input type="text" name="code" value="{{ $values['code'] }}"></td>
            </tr>
            <tr>
                <th>name</th>
                <td><input type="text" name="name" value="{{ $values['name'] }}"></td>
            </tr>
            <tr>
                <th>kana</th>
                <td><input type="text" name="kana" value="{{ $values['kana'] }}"></td>
            </tr>
            <tr>
                <th>tel</th>
                <td><input type="text" name="tel" value="{{ $values['tel'] }}"></td>
            </tr>
            <tr>
                <th>fax</th>
                <td><input type="text" name="fax" value="{{ $values['fax'] }}"></td>
            </tr>
            <tr>
                <th>cutoff</th>
                <td>
                    <select name="cutoff">
                        <option value="">---</option>
                        <option value="5" @if($values['cutoff'] == 5) selected @endif>5日</option>
                        <option value="10" @if($values['cutoff'] == 10) selected @endif>10日</option>
                        <option value="15" @if($values['cutoff'] == 15) selected @endif>15日</option>
                        <option value="20" @if($values['cutoff'] == 20) selected @endif>20日</option>
                        <option value="25" @if($values['cutoff'] == 25) selected @endif>25日</option>
                        <option value="99" @if($values['cutoff'] == 99) selected @endif>末日</option>
                        <option value="100" @if($values['cutoff'] == 100) selected @endif>現金</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>collect</th>
                <td>
                    <select name="collect">
                        <option value="">---</option>
                        @foreach (range(1, 31) as $number)
                            <option value="{{ $number }}" @if($values['collect'] == $number) selected @endif>{{ $number }}日</option>
                        @endforeach
                        <option value="99" @if($values['collect'] == 99) selected @endif>末日</option>
                        <option value="100" @if($values['collect'] == 100) selected @endif>現金</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>is_write</th>
                <td>
                    <select name="is_write">
                        <option value="">---</option>
                        <option value="なし" @if ($values['is_write'] == "なし") selected @endif>なし</option>
                        <option value="単価" @if ($values['is_write'] == "単価") selected @endif>単価</option>
                        <option value="単価合計" @if ($values['is_write'] == "単価合計") selected @endif>単価合計</option>
                        <option value="なし(鋲螺)" @if ($values['is_write'] == "なし(鋲螺)") selected @endif>なし(鋲螺)</option>
                        <option value="単価(鋲螺)" @if ($values['is_write'] == "単価(鋲螺)") selected @endif>単価(鋲螺)</option>
                        <option value="単価合計(鋲螺)" @if ($values['is_write'] == "単価合計(鋲螺)") selected @endif>単価合計(鋲螺)</option>
                        <option value="なし(専用)" @if ($values['is_write'] == "なし(専用)") selected @endif>なし(専用)</option>
                        <option value="単価(専用)" @if ($values['is_write'] == "単価(専用)") selected @endif>単価(専用)</option>
                        <option value="単価合計(専用)" @if ($values['is_write'] == "単価合計(専用)") selected @endif>単価合計(専用)</option>
                    </select>
            </tr>
            <tr>
                <th>address</th>
                <td>
                    <table>
                        <tbody>
                            @foreach ($values['addresses'] as $address)
                            <tr>
                                <td><input type="text" name="address[{{ $address->id }}][type]" value="{{ $address->type }}"></td>
                                <td><input type="text" name="address[{{ $address->id }}][zip_code]" value="{{ $address->zip_code }}"></td>
                                <td><x-admin.webapp.parts.select.prefecture name="address[{{ $address->id }}][prefecture]" :value="$address->prefecture ?? null"/></td>
                                <td><input type="text" name="address[{{ $address->id }}][city]" value="{{ $address->city }}"></td>
                                <td><input type="text" name="address[{{ $address->id }}][street_address]" value="{{ $address->street_address }}"></td>
                                <td><input type="text" name="address[{{ $address->id }}][building_name]" value="{{ $address->building_name }}"></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><input type="text" name="address[new][type]" ></td>
                                <td><input type="text" name="address[new][zip_code]" ></td>
                                <td><x-admin.webapp.parts.select.prefecture name="address[new][prefecture]" /></td>
                                <td><input type="text" name="address[new][city]" ></td>
                                <td><input type="text" name="address[new][street_address]" ></td>
                                <td><input type="text" name="address[new][building_name]" ></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th>email</th>
                <td>
                    <table>
                        <tbody>
                            @foreach ($values['emails'] as $email)
                            <tr>
                                <td><input type="text" name="email[{{ $email->id }}][type]" value="{{ $email->type }}"></td>
                                <td><input type="text" name="email[{{ $email->id }}][email]" value="{{ $email->email }}"></td>
                                <td><input type="text" name="email[{{ $email->id }}][name]" value="{{ $email->name }}"></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><input type="text" name="email[new][type]"></td>
                                <td><input type="text" name="email[new][email]"></td>
                                <td><input type="text" name="email[new][name]"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th>provide</th>
                <td>
                    <table>
                        <tbody>
                            @foreach ($values['provides'] as $provide)
                            <tr>
                                <td>{{ $provide->product->get_display_name() }}</td>
                                <td>{{ $provide->name }}</td>
                                <td>{{ $provide->status }}</td>
                                <td>{{ $provide->price }}</td>
                                <td>[{{ $provide->quantity }}-]</td>
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
                <td colspan="2"><input type="submit" value="{{ $resource }}"></td>
            </tr>
        </tfoot>
    </table>
</form>
{{-- @if ($resource == "edit")
<h3>delete</h3>
<form action="/admin/webapp/company/{{ $values['id'] }}" method="post">
    @method("delete")
    @csrf
    <input type="submit" value="delete">
</form>
@endif --}}
<x-slot name="script">
</x-slot>
</x-admin.webapp.frame.basic>