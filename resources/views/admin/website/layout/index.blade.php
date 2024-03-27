<x-admin.website.frame.basic title="Layout - Setting" heading="レイアウト編集">
    <x-slot name="head">
    </x-slot>
    <form action="/admin/website/layout" method="post">
        @csrf
        <table>
            <tbody>
                <tr>
                    <th>レイアウト選択</th>
                    <td><x-admin.website.parts.select.layout-name name="select" :value="$layout->name" /></td>
                        <td><button type="submit">save</button></td>
                </tr>
            </tbody>
        </table>
    </form>
    <x-slot name="hidden">
    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-admin.website.frame.basic>