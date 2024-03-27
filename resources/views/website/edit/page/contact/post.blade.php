<x-website.frame.edit>
<x-slot name="title">contact</x-slot>
<x-slot name="id">contact</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/contact">問い合わせ</a> > </x-slot>
<section id="post">
    <h3>contact post</h3>
    <dl id="dl-contact-post">
        <dt>
            <dl class="dl-flex dl-contact-post-header">
                <dd class="dd-contact-post-created_at">created_at</dd>
                <dd class="dd-contact-post-status">status</dd>
                <dd class="dd-contact-post-from">from</dd>
                <dd class="dd-contact-post-values">values</dd>
                <dd class="dd-contact-post-button">button</dd>
            </dl>
        </dt>
        @foreach ($posts as $post)
            <dd>
                <dl class="dl-flex dl-contact-post-body">
                    <dd class="dd-contact-post-created_at">{!! $post->created_at ?  (new DateTime($post->created_at))->format('Y-m-d H:i') : null !!}</dd>
                    <dd class="dd-contact-post-status">{{ isset($statuses[$post->status]) ? $statuses[$post->status] : null }}</dd>
                    <dd class="dd-contact-post-from">
                        <dl>
                            <dd class="dd-contact-post-from-name">{{ isset($post->values, $post->values["name"]) ? $post->values["name"] : null }}</dd>
                            <dd class="dd-contact-post-from-email">{{ isset($post->values, $post->values["email"]) ? $post->values["email"] : null }}</dd>
                        </dl>
                    </dd>
                    <dd class="dd-contact-post-values">
                        @foreach ($post->values as $key => $value)
                            @if (!in_array($key, array("email", "name")))
                                <dl class="dl-contact-post-values-body dl-flex">
                                    <dt class="dt-contact-post-values-key">{{ $key }}</dt>
                                    <dd class="dd-contact-post-values-value">{!! nl2br($value) !!}</dd>
                                </dl>
                            @endif
                        @endforeach
                    </dd>
                    <dd class="dd-contact-post-button">
                        <button type="button">返信</button>
                        @foreach ($statuses as $status_key => $status_value)
                            <button type="button" onclick="console.log('{{ $status_key }}');">{{ $status_value }}</button>
                        @endforeach
                    </dd>
                </dl>
            </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
    
</x-website.frame.edit>