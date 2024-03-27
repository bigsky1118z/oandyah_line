@props(array(
    "id"        =>  null,
    "onchange"  =>  null,
    "users"     =>  array(),
))
<div @isset($id) id ="{{ $id }}"  @endisset class="modal">
    <div class="modal-content">
        <h2>性別</h2>
        <table>
            <tr>
                <td>男性</td>
                <td><input type="checkbox" id="modal_filter_gender_male" name="filter[][gender][oneOf][]" value="male"></td>
            </tr>
            <tr>
                <td>女性</td>
                <td><input type="checkbox" id="modal_filter_gender_female" name="filter[][gender][oneOf][]" value="male"></td>
            </tr>
        </table>
        <h2>年齢</h2>
        <table>
            <tr>
                <td>以上</td>
                <td>以下</td>
            </tr>
            <tr>
                <select name="filter[age][type]" id=""></select>
                <td>15</td>
                <td><input type="checkbox" id="modal_filter_gender_male" value="male"></td>
            </tr>
            <tr>
                <td>男性</td>
                <td><input type="checkbox" id="modal_filter_gender_female" value="male"></td>
            </tr>
        </table>
    </div>
    <p style="text-align: center;"><button type="button" onclick="closeModal(this);">閉じる</button></p>
</div>