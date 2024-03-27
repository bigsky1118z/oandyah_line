<section>
    <h2>{{ $page->title }}</h2>
    <dl>
        <dd>
            @foreach ($page->contact->forms as $form)
                @if ($form->active)
                    <dl>
                        <dt>{{ $form->title }}</dt>
                        <dd><x-website.main.contact.input :form="$form" /></dd>
                    </dl>
                @endif
            @endforeach
        </dd>
        <dd><button type="submit">送信</button></dd>
    </dl>
</section>