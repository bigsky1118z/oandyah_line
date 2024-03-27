<x-admin.api.line.frame.basic title="チャンネル登録" heading="チャンネル登録">
<x-slot name="head">
<style>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    textarea {
        resize: none;
    }
</style>
</x-slot>
<form action="/api/line/create" method="post">
    <dl>
        <dt>Webhook URL</dt>
        <dd>https://oandyah.com/api/line/<input type="text" name="channel_name" required placeholder="英数"></dd>
    </dl>
    <dl>
        <dt>チャネルアクセストークン（長期）</dt>
        <dd><textarea name="access_token" required cols="56" rows="3"></textarea></dd>
    </dl>
    <p><button type="submit">create</button></p>
</form>
</x-admin.api.line.frame.basic>