<x-admin.webapp.frame.basic title="Webapp Product">
<x-slot name="head">
</x-slot>
<a href="/admin/webapp/product/{{ $product['id'] }}/edit">edit</a>
<table>
    <tbody>
        <tr>
            <th>code</th>
            <td>{{ $product->code }}</td>
        </tr>
        <tr>
            <th>company</th>
            <td>{{ $product->company }}</td>
        </tr>
        <tr>
            <th>name</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>color</th>
            <td>{{ $product->color }}</td>
        </tr>
        <tr>
            <th>sheet</th>
            <td>{{ $product->sheet }}</td>
        </tr>
        <tr>
            <th>gauge</th>
            <td>{{ (int) $product->gauge }}</td>
        </tr>
        <tr>
            <th>type</th>
            <td>{{ $product->type }}</td>
        </tr>
        <tr>
            <th>width</th>
            <td>{{ (int) $product->width }}</td>
        </tr>
        <tr>
            <th>length</th>
            <td>{{ (int) $product->length }}</td>
        </tr>
        <tr>
            <th>height</th>
            <td>{{ (int) $product->height }}</td>
        </tr>
        <tr>
            <th>cutting</th>
            <td>{{ $product->cutting }}</td>
        </tr>
        <tr>
            <th>making</th>
            <td>{{ $product->making }}</td>
        </tr>
        <tr>
            <th>printing</th>
            <td>{{ $product->printing }}</td>
        </tr>
        <tr>
            <th>semi_products</th>
            <td>
                <table>
                    <tbody>
                        @foreach ($product->semi_products as $semi_product)
                        <tr>
                            <td>{{ $semi_product->semi_product->code }}</td>
                            <td>{{ $semi_product->semi_product->get_display_name() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</x-admin.webapp.frame.basic>