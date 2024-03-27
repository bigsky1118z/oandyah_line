@php
    use App\Models\Website\WebsitePage;

    $statuses   =   WebsitePage::$statuses;
@endphp

@isset($values, $values["page_type"])
    <dl id="dl-{{ $values["page_type"] }}-create">
        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">パス</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <span>https://*****.***/</span><input type="text" name="page_path" value="{{ isset($values['page_path']) ? $values['page_path'] : null }}" required>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">タイトル</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <input type="text" name="page_title" value="{{ isset($values['page_title']) ? $values['page_title'] : null }}">
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">サムネイル画像URL</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <input type="text" name="page_image_thumbnail_url" value="{{ isset($values['page_image_thumbnail_url']) ? $values['page_image_thumbnail_url'] : null }}">
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">ヘッダー画像URL</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <input type="text" name="page_image_header_url" value="{{ isset($values['page_image_header_url']) ? $values['page_image_header_url'] : null }}">
                </dd>
            </dl>
        </dd>

        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-create-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">概要</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <textarea name="page_description">{{ isset($values['page_description']) ? $values['page_description'] : null }}</textarea>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">公開設定</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <select name="page_status">
                        @foreach ($statuses as $status => $status_title)
                            <option value="{{ $status }}" @selected(isset($values["page_status"]) && $values["page_status"] == $status)>{{ $status_title }}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">開始日時</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <input type="datetime-local" name="page_valid_at" value="{{ isset($values['page_valid_at']) ? $values['page_valid_at'] : null }}">
                </dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item">終了日時</dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <input type="datetime-local" name="page_expired_at" value="{{ isset($values['page_expired_at']) ? $values['page_expired_at'] : null }}">
                </dd>
            </dl>
        </dd>

        <dd>
            <dl class="dl-flex dl-{{ $values["page_type"] }}-cretate-body">
                <dt class="dt-{{ $values["page_type"] }}-create-item"></dt>
                <dd class="dd-{{ $values["page_type"] }}-create-value">
                    <button type="submit">保存</button>
                </dd>
            </dl>
        </dd>
    </dl>
@endisset
