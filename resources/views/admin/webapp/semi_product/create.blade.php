<x-admin.webapp.frame.basic title="Semi Product">
@php
    $values =   array();
    $keys   =   array(
        'id',
        'code',
        'company',
        'name',
        'color',
        'sheet',
        'gauge',
        'width',
        'length',
        'height',
        'semi_type',
        'cutting',
        'making',
        'printing',
    );
    if ($errors->any()) {
        foreach ($keys as $key) {
            $values[$key]   =   old($key);
        }
    } elseif (isset($semi_product)){
        foreach ($keys as $key) {
            $values[$key]   =   $semi_product[$key];
        }
    } elseif (!isset($semi_product)) {
        foreach ($keys as $key) {
            $values[$key]   =   null;
        }
    }
@endphp
<x-slot name="head">
    <style>
        input[type="text"] {
            width: 150px;
        }
        input[type="number"] {
            width: 50px;
        }
        table, p {
            width: 1000px;
            text-align: center;
        }
        table table {
            width: 100%;
            text-align: center;
        }
        table tbody tr td ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

    </style>
</x-slot>
@if ($resource=="create")
<x-slot name="heading">半製品登録</x-slot>
@elseif($resource=="edit")
<x-slot name="heading">半製品編集</x-slot>
@endif
@if($errors->any())
<ul>
    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
</ul>
@endif
@if ($resource == "create")
    <form action="/admin/webapp/semi_product" method="post">
@elseif($resource == "edit")
    <form action="/admin/webapp/semi_product/{{ $values['id'] }}" method="post">
    @method('put')
@endif
    @csrf
    <h3>Status</h3>
    <table>
        <thead>
            <tr>
                <th>code</th>
                <th>company</th>
                <th>name</th>
                <th>color</th>
                <th>sheet</th>
                <th>gauge</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="code"      @isset($values['code']) value="{{ $values['code'] }}" @endisset></td>
                <td><input type="text" name="company"   @isset($values['company']) value="{{ $values['company'] }}" @endisset></td>
                <td><input type="text" name="name"      @isset($values['name']) value="{{ $values['name'] }}" @endisset></td>
                <td><input type="text" name="color"     @isset($values['color']) value="{{ $values['color'] }}" @endisset></td>
                <td>
                    <select name="sheet">
                        <option value="">---</option>
                        <option value="KIボール" @isset($values['sheet']) @if ($values['sheet'] == "KIボール") selected @endif @endisset>KIボール</option>
                        <option value="特クラフト" @isset($values['sheet']) @if ($values['sheet'] == "特クラフト") selected @endif @endisset>特クラフト</option>
                        <option value="山一クラフト" @isset($values['sheet']) @if ($values['sheet'] == "山一クラフト") selected @endif @endisset>山一クラフト</option>
                        <option value="KSクラフト" @isset($values['sheet']) @if ($values['sheet'] == "KSクラフト") selected @endif @endisset>KSクラフト</option>
                        <option value="コートボール" @isset($values['sheet']) @if ($values['sheet'] == "コートボール") selected @endif @endisset>コートボール</option>
                        <option value="白菊" @isset($values['sheet']) @if ($values['sheet'] == "白菊") selected @endif @endisset>白菊</option>
                        <option value="チップボール" @isset($values['sheet']) @if ($values['sheet'] == "チップボール") selected @endif @endisset>チップボール</option>
                    </select>
                </td>
                <td>
                    <select name="gauge">
                        <option value="">---</option>
                        <option value="6" @isset($values['gauge']) @if ($values['gauge'] == 6) selected @endif @endisset>6</option>
                        <option value="7" @isset($values['gauge']) @if ($values['gauge'] == 7) selected @endif @endisset>7</option>
                        <option value="8" @isset($values['gauge']) @if ($values['gauge'] == 8) selected @endif @endisset>8</option>
                        <option value="9" @isset($values['gauge']) @if ($values['gauge'] == 9) selected @endif @endisset>9</option>
                        <option value="10" @isset($values['gauge']) @if ($values['gauge'] == 10) selected @endif @endisset>10</option>
                        <option value="11" @isset($values['gauge']) @if ($values['gauge'] == 11) selected @endif @endisset>11</option>
                        <option value="12" @isset($values['gauge']) @if ($values['gauge'] == 12) selected @endif @endisset>12</option>
                        <option value="13" @isset($values['gauge']) @if ($values['gauge'] == 13) selected @endif @endisset>13</option>
                        <option value="14" @isset($values['gauge']) @if ($values['gauge'] == 14) selected @endif @endisset>14</option>
                    </select>
                    <span>号</span>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>semi_type</th>
                <th>width</th>
                <th>length</th>
                <th>height</th>
                <th>cutting</th>
                <th>making</th>
                <th>printing</th>
            </tr>
        </thead>
        <tbody>
            <td>
                <select name="semi_type">
                    <option value="">---</option>
                    <option value="C式[ミ]" @isset($values['semi_type']) @if ($values['semi_type'] == "C式[ミ]") selected @endif @endisset>C式[ミ]</option>
                    <option value="C式[フタ]" @isset($values['semi_type']) @if ($values['semi_type'] == "C式[フタ]") selected @endif @endisset>C式[フタ]</option>
                    <option value="台紙" @isset($values['semi_type']) @if ($values['semi_type'] == "台紙") selected @endif @endisset>台紙</option>
                </select>    
            </td>
            <td><input type="number" name="width"     @isset($values['width']) value="{{ (int) $values['width'] }}" @endisset>mm</td>
            <td><input type="number" name="length"    @isset($values['length']) value="{{ (int) $values['length'] }}" @endisset>mm</td>
            <td><input type="number" name="height"    @isset($values['height']) value="{{ (int) $values['height'] }}" @endisset>mm</td>
            <td>
                <select name="cutting">
                    <option value="">---</option>
                    <option value="自社" @isset($values['cutting']) @if ($values['cutting'] == "自社") selected @endif @endisset>自社</option>
                    <option value="辰巳" @isset($values['cutting']) @if ($values['cutting'] == "辰巳") selected @endif @endisset>辰巳</option>
                </select>
            </td>
            <td>
                <select name="making">
                    <option value="">---</option>
                    <option value="自社" @isset($values['making']) @if ($values['making'] == "自社") selected @endif @endisset>自社</option>
                    <option value="辰巳" @isset($values['making']) @if ($values['making'] == "辰巳") selected @endif @endisset>辰巳</option>
                </select>
            </td>
            <td>
                <select name="printing">
                    <option value="">---</option>
                    <option value="森川" @isset($values['printing']) @if ($values['printing'] == "森川") selected @endif @endisset>森川</option>
                    <option value="山伸" @isset($values['printing']) @if ($values['printing'] == "山伸") selected @endif @endisset>山伸</option>
                </select>
            </td>
        </tbody>
    </table>
    <h3>Regist</h3>
    <table>
        <thead>
            <tr>
                @if ($resource=="edit")
                    <th>registed_products</th>                
                @endif
                <th>add_products</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @if ($resource=="edit")
                    <td>
                        <table>
                            @foreach ($semi_product->products as $product)
                            <tr><td><label for="checkbox-registed-{{ $product->product_id }}"><input type="checkbox" id="checkbox-registed-{{ $product->product_id }}" name="products[registed][]" value="{{ $product->product_id }}" checked>{{ $product->product->get_display_name() }}</label></td></tr>
                            @endforeach
                        </table>
                    </td>
                @endif
                <td>
                    <table>
                        <tr>
                            <td>
                                <select name="products[add][]">
                                    <option value="">---</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->get_display_name() }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="products[add][]">
                                    <option value="">---</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->get_display_name() }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>


    <p><button type="submit">{{ $resource }}</button></p>
</form>
@if ($resource=="edit")
<h3>delete</h3>
<form action="/admin/webapp/semi_product/{{ $values['id'] }}" method="post">
    @method('delete')
    @csrf
    <p><button type="submit">delete</button></p>
</form>
@endif
</x-admin.webapp.frame.basic>