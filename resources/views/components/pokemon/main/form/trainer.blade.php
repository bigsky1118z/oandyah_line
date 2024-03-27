<form action="/pokemon/{{ isset($action) ? $action : trainer }}" method="post">
    @csrf
    <dl id="dl-trainer-form">
        <dd>
            <dl class="dl-trainer-form-content">
                <dt class="dt-trainer-form-content-title">ユーザー名</dt>
                <dd class="dt-trainer-form-content-value">
                    <input type="text" name="user_name" @isset($old["user_name"]) value="{{ $old["user_name"] }}" @endisset required>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-trainer-form-content">
                <dt class="dt-trainer-form-content-title">トレーナー名</dt>
                <dd class="dt-trainer-form-content-value">
                    <input type="text" name="trainer_name" @isset($old["trainer_name"]) value="{{ $old["trainer_name"] }}" @endisset required>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-trainer-form-content">
                <dd class="dd-trainer-form-content-submit">
                    <button type="submit" class="button button-create">新規登録</button>
                </dd>
            </dl>
        </dd>
    </dl>
</form>