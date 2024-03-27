<x-admin.webapp.frame.basic title="Company" hedding="単価一覧">
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
<form action="/admin/webapp/provide" method="get">
    <table>
        <thead>
            <tr>
                <th>company</th>
                <th>product</th>
                <th>order_by</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="company[input]"></td>
                <td><input type="text" name="product[input]"></td>
                <td><input type="text" name="order_by"></td>
            </tr>
            <tr>
                <td><input type="radio" name="company[type]" value="and" checked>and <input type="radio" name="company[type]" value="or">or</td>
                <td><input type="radio" name="product[type]" value="and" checked>and <input type="radio" name="product[type]" value="or">or</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <p><button type="submit">search</button></p>
</form>

<table>
    <thead>
        <tr>
            <th colspan="2">company</th>
            <th colspan="2">product</th>
            <th>price</th>
            <th>status</th>
            <th>delivery</th>
            <th>leadtime</th>
            <th>start_date</th>
            <th>end_date</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @if($provides->isEmpty())
            <tr>
                <td colspan="10">no provides</td>
            </tr>
        @elseif (!$provides->isEmpty())
            @foreach ($provides as $provide)
            <tr>
                <td>{{ $provide->company->code }}</td>
                <td>{{ $provide->company->name }}</td>
                <td>{{ $provide->product->code }}</td>

                <td>
                    <ul>
                        <li>{{ $provide->product->get_display_name() }}</li>
                        <li>{{ $provide->product->get_size() }}</li>
                    </ul>
                </td>
                <td>{{ $provide->price }}@if ($provide->quantity >1) [{{ $provide->quantity }}-] @endif</td>
                <td>{{ $provide->status }}</td>
                <td>{{ $provide->delivery }}</td>
                @switch($provide->leadtime)
                    @case(0)
                        <td>当日</td>
                       @break
                    @case(1)
                        <td>翌日</td>
                       @break
                    @default
                        <td>{{ $provide->leadtime }}日以降</td>
                @endswitch
                <td>{{ (new DateTime($provide->start_date))->format('Y-m-d') }}</td>
                <td>@if ($provide->end_date){{ (new DateTime($provide->end_date))->format('Y-m-d') }}@endif</td>
                <td>
                    <ul>
                        <li><a href="/admin/webapp/provide/{{ $provide }}">detail</a></li>
                        <li><a href="/admin/webapp/provide/{{ $provide }}/edit">edit</a></li>
                    </ul>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10"><a href="/admin/webapp/provide/create">add</a></td>
        </tr>
    </tfoot>
</table>
<x-slot name="script">
</x-slot>
</x-admin.webapp.frame.basic>