<div @isset($id) id ="{{ $id }}"  @endisset class="modal @isset($type) modal-{{ $type }} @endisset">
    <div class="modal-content @isset($type) modal-{{ $type }}-content @endisset">
        {{ $slot }}
    </div>
    <p class="modal-button" style="text-align: center;">
        <button type="button" class="outputModal" onclick="outputModal(this);">入力</button>
        <button type="button" class="cancelModal" onclick="cancelModal(this);">キャンセル</button>
    </p>
</div>