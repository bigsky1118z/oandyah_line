<x-admin.webapp.frame.basic title="Webapp Product">
<x-slot name="head">
</x-slot>
<a href="/admin/webapp/semi_product/{{ $semi_product['id'] }}/edit">edit</a>
<table>
    <tbody>
        <tr>
            <th>code</th>
            <td>{{ $semi_product->code }}</td>
        </tr>
        <tr>
            <th>company</th>
            <td>{{ $semi_product->company }}</td>
        </tr>
        <tr>
            <th>name</th>
            <td>{{ $semi_product->name }}</td>
        </tr>
        <tr>
            <th>color</th>
            <td>{{ $semi_product->color }}</td>
        </tr>
        <tr>
            <th>sheet</th>
            <td>{{ $semi_product->sheet }}</td>
        </tr>
        <tr>
            <th>gauge</th>
            <td>{{ (int) $semi_product->gauge }}</td>
        </tr>
        <tr>
            <th>type</th>
            <td>{{ $semi_product->type }}</td>
        </tr>
        <tr>
            <th>width</th>
            <td>{{ (int) $semi_product->width }}</td>
        </tr>
        <tr>
            <th>length</th>
            <td>{{ (int) $semi_product->length }}</td>
        </tr>
        <tr>
            <th>height</th>
            <td>{{ (int) $semi_product->height }}</td>
        </tr>
        <tr>
            <th>cutting</th>
            <td>{{ $semi_product->cutting }}</td>
        </tr>
        <tr>
            <th>making</th>
            <td>{{ $semi_product->making }}</td>
        </tr>
        <tr>
            <th>printing</th>
            <td>{{ $semi_product->printing }}</td>
        </tr>
        <tr>
            <th>products</th>
            <td>
                <table>
                    <tbody>
                        @foreach ($semi_product->products as $product)
                        <tr>
                            <td>{{ $product->product->code }}</td>
                            <td>{{ $product->product->get_display_name() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</x-admin.webapp.frame.basic>