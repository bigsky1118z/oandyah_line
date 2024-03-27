<h2>{{ $page->title }}</h2>
@foreach ($contacts as $contact)
    <dl>
        <dt>{{ $contact->name }}</dt>
        <dd>{{ $contact->email }}</dd>
        <dd>{{ $contact->content }}</dd>
    </dl>
@endforeach