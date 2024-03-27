<dl @isset($classdl) class="{{ $classdl }}" @endisset>
    <dt>送信方法</dt>
    <dd class="select-dd">
        <x-admin.api.line.parts.endpoint.endpoint name="endpoint[type]" id="endpoint-type" required="required" />
    </dd>
    <dd class="content-dd"></dd>
</dl>