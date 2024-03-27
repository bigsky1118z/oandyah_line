@props(array(
    "id"        =>  null,
    "onchange"  =>  null,
    "users"     =>  array(),
))
<div @isset($id) id ="{{ $id }}"  @endisset class="modal">
    <div class="modal-content">
        <ul>
            @foreach ($users as $user)
            <li><label for="modal_user_id_{{ $user->id }}"><input type="checkbox" id="modal_user_id_{{ $user->id }}" value="{{ $user->id }}" @isset($onchange) onchange="{{ $onchange }}" @endisset>{{ $user->nickname ? $user->nickname : $user->display_name }}</label></li>
            @endforeach
        </ul>
    </div>
    <p style="text-align: center;"><button type="button" onclick="closeModal(this);">閉じる</button></p>
</div>