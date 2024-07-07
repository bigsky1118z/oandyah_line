<div id="{{ $id ?? null }}">

    <table>
        <tr>
            <th>男女別</th>
            <td>
                <ul>
                    <li>
                        <input type="checkbox" name="filter[oneOf][]" id="filter-one_of-male" value="male">
                        <label for="filter-one_of-male">男性</label>
                    </li>
                    <li>
                        <input type="checkbox" name="filter[oneOf][]" id="filter-one_of-female" value="female">
                        <label for="filter-one_of-female">女性</label>
                    </li>
                </ul>
            </td>
            <th>年齢別</th>
            <td>
                <ul>

                </ul>
            </td>
        </tr>
        <tr>
            <th>上限</th>
            <td><input type="number" name="limit[max]" value="{{ $message->limit['max'] ?? null }}"></td>
        </tr>
    </table>
</div>