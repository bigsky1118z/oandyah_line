<x-admin.api.line.frame.basic>
<x-slot name="head">
</x-slot>
<h2>data</h2>
<table>
    <thead>
        <tr>
            <th>event</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $datum)
        <tr>
            <td>{{ $datum }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-admin.api.line.frame.basic>