@php
    use App\Models\App\AppReply;
@endphp
<table id="{{ $id ?? null }}">
    <tbody>
        <tr>
            <th>一致条件</th>
            <td>
                <select name="query[match]">
                    @foreach (AppReply::$matches as $key => $value)
                        <option value="{{ $key }}" @selected($key == ($reply->query["match"] ?? null))>{{ $value }}</option>
                    @endforeach
                </select>
            </td>
        <tr>
            <th>キーワード</th>
            <td>
                <table>
                    <tbody>
                        @foreach (($reply->query["keywords"] ?? array()) as $keyword)
                            <tr>
                                <td><input type="text" name="query[keywords][]" value="{{ $keyword }}"></td>
                                <td><button type="button" onclick="this.closest('tr').remove();">✕</button></td>
                            </tr>                            
                        @endforeach
                        <tr>
                            <td><input type="text" name="query[keywords][]"></td>
                            <td><button type="button" onclick="this.closest('tr').remove();">✕</button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><button type="button" onclick="add_keywords(this);">キーワード追加</button></td>
                        </tr>
                        <tr class="sumple-reply-query-keywords-tr hidden">
                            <td><input type="text" name="query[keywords][]"></td>
                            <td><button type="button" onclick="this.closest('tr').remove();">✕</button></td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        </tr>
    </tbody>
</table>