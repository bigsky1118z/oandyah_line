<x-admin.api.line.frame.basic>
<x-slot name="head">
<style>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
</x-slot>
<h3>statistics</h3>
@isset($statistics)
<table>
    <tbody>
        <tr>
            <th>overview</th>
            <td>
                <table>
                    <tbody>
                        @foreach ($statistics['overview'] as $key => $value)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th>messages</th>
            @foreach ($statistics['messages'] as $message)
            <td>
                <table>
                    <tbody>
                        @foreach ($message as $key => $value)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
            @endforeach
        </tr>
        <tr>
            <th>clicks</th>
            @foreach ($statistics['clicks'] as $click)
            <td>
                <table>
                    <tbody>
                        @foreach ($click as $key => $value)
                        <tr>
                            <th>{{ $key }}</th>
                            <td>{{ $value }}</td>
                        </tr>            
                        @endforeach
                    </tbody>
                </table>
            </td>
            @endforeach
        </tr>
    </tbody>
</table>

@endisset
</x-admin.api.line.frame.basic>