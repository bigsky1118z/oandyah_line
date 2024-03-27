<x-line.frame.iframe>
    <x-slot name="id">line-iframe-to</x-slot>
    {{-- <x-slot name="head"></x-slot> --}}
    {{-- <x-slot name="header"></x-slot> --}}
    <section id="select">
        <form>
            <dl id="dl-line-message-iframe-to">
                <dt id="dt-line-message-iframe-to-header">
                    <dl class="dl-line-message-iframe-to-button">
                        <dd class="dd-line-message-iframe-to-button-true" onclick="select_all(true);">全選択</dd>
                        <dd class="dd-line-message-iframe-to-button-false" onclick="select_all(false);">全取消</dd>
                    </dl>
                </dt>
                <dd id="dd-line-message-iframe-to-body">
                    @foreach ($line->friends as $friend)
                        <dl class="dl-line-message-iframe-to-value{{ isset($message["line_user_ids"]) && in_array($friend->line_user_id, $message["line_user_ids"]) ? ' dl-line-message-iframe-to-checked' : null }}">
                            <dt class="dt-line-message-iframe-to-checkbox">
                                <input type="checkbox" id="friend_{{ $friend->id }}" name="to[]" value="{{ $friend->line_user_id }}" data-name="{{ $friend->get_name() }}" onchange="user_is_checked(this);" @checked(isset($message["line_user_ids"]) && in_array($friend->line_user_id, $message["line_user_ids"]))>
                            </dt>
                            <dd class="dd-line-message-iframe-to-name">
                                <label for="friend_{{ $friend->id }}">{{ $friend->naming ? $friend->naming : $friend->display_name }}</label>
                            </dd>
                        </dl>
                    @endforeach
                </dd>
                <dd id="dd-line-message-iframe-to-footer">
                    <dl class="dl-line-message-iframe-to-button">
                        <dd class="dd-line-message-iframe-to-button-true" onclick="select_all(true);">全選択</dd>
                        <dd class="dd-line-message-iframe-to-button-false" onclick="select_all(false);">全取消</dd>
                    </dl>
               </dt>
             </dl>
        </form>
    </section>
    {{-- <x-slot name="footer"></x-slot> --}}
    {{-- <x-slot name="hidden"></x-slot> --}}
    <x-slot name="script">
        <script>
            function user_is_checked(checkbox){
                const class_name    =   "dl-line-message-iframe-to-checked";
                const dl            =   checkbox.closest("dl.dl-line-message-iframe-to-value");
                checkbox.checked ? dl.classList.add(class_name) : dl.classList.remove(class_name);
            }
            function select_all(boolean){
                const class_name    =   "dl-line-message-iframe-to-checked";
                const dd            =   document.getElementById("dd-line-message-iframe-to-body");
                dd.querySelectorAll("dl.dl-line-message-iframe-to-value").forEach(dl => {
                    boolean ? dl.classList.add(class_name)  : dl.classList.remove(class_name);
                    dl.querySelector("dt.dt-line-message-iframe-to-checkbox > input[type=checkbox]").checked = boolean;
                });
            }
        </script>
    </x-slot>
</x-line.frame.iframe>