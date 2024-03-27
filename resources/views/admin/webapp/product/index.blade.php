<x-admin.webapp.frame.basic title="Webapp Product" heading="製品一覧">
<x-slot name="head">
    <style>
        input[type="text"] {
            width: 150px;
        }
        input[type="number"] {
            width: 50px;
        }
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
<form action="/admin/webapp/product" method="get">
    <table style="width:1000px">
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
                <td><input type="text" name="code"      @isset($query['code']) value="{{ $query['code'] }}" @endisset></td>
                <td><input type="text" name="company"   @isset($query['company']) value="{{ $query['company'] }}" @endisset></td>
                <td><input type="text" name="name"      @isset($query['name']) value="{{ $query['name'] }}" @endisset></td>
                <td><input type="text" name="color"     @isset($query['color']) value="{{ $query['color'] }}" @endisset></td>
                <td>
                    <select name="sheet">
                        <option value="">---</option>
                        <option value="KIボール" @isset($query['sheet']) @if ($query['sheet'] == "KIボール") selected @endif @endisset>KIボール</option>
                        <option value="特クラフト" @isset($query['sheet']) @if ($query['sheet'] == "特クラフト") selected @endif @endisset>特クラフト</option>
                        <option value="山一クラフト" @isset($query['sheet']) @if ($query['sheet'] == "山一クラフト") selected @endif @endisset>山一クラフト</option>
                        <option value="KSクラフト" @isset($query['sheet']) @if ($query['sheet'] == "KSクラフト") selected @endif @endisset>KSクラフト</option>
                        <option value="コートボール" @isset($query['sheet']) @if ($query['sheet'] == "コートボール") selected @endif @endisset>コートボール</option>
                        <option value="白菊" @isset($query['sheet']) @if ($query['sheet'] == "白菊") selected @endif @endisset>白菊</option>
                        <option value="チップボール" @isset($query['sheet']) @if ($query['sheet'] == "チップボール") selected @endif @endisset>チップボール</option>
                    </select>
                </td>
                <td>
                    <select name="gauge">
                        <option value="">---</option>
                        <option value="6" @isset($query['gauge']) @if ($query['gauge'] == 6) selected @endif @endisset>6</option>
                        <option value="7" @isset($query['gauge']) @if ($query['gauge'] == 7) selected @endif @endisset>7</option>
                        <option value="8" @isset($query['gauge']) @if ($query['gauge'] == 8) selected @endif @endisset>8</option>
                        <option value="9" @isset($query['gauge']) @if ($query['gauge'] == 9) selected @endif @endisset>9</option>
                        <option value="10" @isset($query['gauge']) @if ($query['gauge'] == 10) selected @endif @endisset>10</option>
                        <option value="11" @isset($query['gauge']) @if ($query['gauge'] == 11) selected @endif @endisset>11</option>
                        <option value="12" @isset($query['gauge']) @if ($query['gauge'] == 12) selected @endif @endisset>12</option>
                        <option value="13" @isset($query['gauge']) @if ($query['gauge'] == 13) selected @endif @endisset>13</option>
                        <option value="14" @isset($query['gauge']) @if ($query['gauge'] == 14) selected @endif @endisset>14</option>
                    </select>
                    <span>号</span>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width:1000px">
        <thead>
            <tr>
                <th>type</th>
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
                <select name="type">
                    <option value="">---</option>
                    <option value="B式" @isset($query['type']) @if ($query['type'] == "B式") selected @endif @endisset>B式</option>
                    <option value="C式" @isset($query['type']) @if ($query['type'] == "C式") selected @endif @endisset>C式</option>
                    <option value="C式(生地)" @isset($query['type']) @if ($query['type'] == "C式(生地)") selected @endif @endisset>C式(生地)</option>
                    <option value="板紙" @isset($query['type']) @if ($query['type'] == "板紙") selected @endif @endisset>板紙</option>
                    <option value="パッキン" @isset($query['type']) @if ($query['type'] == "パッキン") selected @endif @endisset>パッキン</option>
                    <option value="台紙" @isset($query['type']) @if ($query['type'] == "台紙") selected @endif @endisset>台紙</option>
                </select>
            </td>
            <td>
                <input type="number" name="width[over]"     @isset($query['width']['over']) value="{{ $query['width']['over'] }}" @endisset>mm以上<br>
                <input type="number" name="width[under]"    @isset($query['width']['under']) value="{{ $query['width']['under'] }}" @endisset>mm以下
            </td>
            <td>
                <input type="number" name="length[over]"    @isset($query['length']['over']) value="{{ $query['length']['over'] }}" @endisset>mm以上<br>
                <input type="number" name="length[under]"   @isset($query['length']['under']) value="{{ $query['length']['under'] }}" @endisset>mm以下
            </td>
            <td>
                <input type="number" name="height[over]"    @isset($query['height']['over']) value="{{ $query['height']['over'] }}" @endisset>mm以上<br>
                <input type="number" name="height[under]"   @isset($query['height']['under']) value="{{ $query['height']['under'] }}" @endisset>mm以下
            </td>
            <td>
                <select name="cutting">
                    <option value="">---</option>
                    <option value="自社" @isset($query['cutting']) @if ($query['cutting'] == "自社") selected @endif @endisset>自社</option>
                    <option value="辰巳" @isset($query['cutting']) @if ($query['cutting'] == "辰巳") selected @endif @endisset>辰巳</option>
                </select>
            </td>
            <td>
                <select name="making">
                    <option value="">---</option>
                    <option value="自社" @isset($query['making']) @if ($query['making'] == "自社") selected @endif @endisset>自社</option>
                    <option value="辰巳" @isset($query['making']) @if ($query['making'] == "辰巳") selected @endif @endisset>辰巳</option>
                </select>
            </td>
            <td>
                <select name="printing">
                    <option value="">---</option>
                    <option value="森川" @isset($query['printing']) @if ($query['printing'] == "森川") selected @endif @endisset>森川</option>
                    <option value="山伸" @isset($query['printing']) @if ($query['printing'] == "山伸") selected @endif @endisset>山伸</option>
                </select>
            </td>
        </tbody>
    </table>
    <p><button type="submit">search</button></p>
</form>
<table>
    <thead>
        <tr>
            <th>code</th>
            <th>get_display_name</th>
            <th>get_size</th>
            <th>sheet</th>
            <th>gauge</th>
            <th>type</th>
            <th>cutting</th>
            <th>making</th>
            <th>printing</th>
            <th>semi_products</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @if (!$products->isEmpty())
        @foreach ($products as $product)
        <tr>
            <td>{{ $product['code'] }}</td>
            <td>{{ $product->get_display_name() }}</td>
            <td>{{ $product->get_size() }}</td>
            <td>{{ $product['sheet'] }}</td>
            <td>{{ (int) $product['gauge'] }}</td>
            <td>{{ $product['type'] }}</td>
            <td>{{ $product['cutting'] }}</td>
            <td>{{ $product['making'] }}</td>
            <td>{{ $product['printing'] }}</td>
            <td>
                <ul>
                    @foreach ($product->semi_products as $semi_product)
                    <li>{{ $semi_product->semi_product->code }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <ul>
                    <li><a href="/admin/webapp/product/{{ $product['id'] }}">detail</a></li>
                    <li><a href="/admin/webapp/product/{{ $product['id'] }}/edit">edit</a></li>
                </ul>
            </td>
        </tr>
        @endforeach
        @elseif($products->isEmpty())
        <tr><td colspan="14">no products</td></tr>
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="11"><a href="/admin/webapp/product/create">add</a></td>
        </tr>
    </tfoot>
</table>
</x-admin.webapp.frame.basic>