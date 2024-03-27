<x-sns.frame.basic>
<x-slot name="id">index</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="description"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
<x-slot name="header"></x-slot>
@auth
@endauth
@guest
    <section id="regist">
        <h2></h2>
        <form action="/sns/regist" method="post">
            @csrf
            <dl>
                <dd><input type="email" name="email" required placeholder="email"></dd>
                <dd><input type="text" name="nickname" required placeholder="nickname"></dd>
                <dd><input type="password" name="password" required placeholder="password"></dd>
                <dd><input type="password" name="password_confirmation" required placeholder="password_confirmation"></dd>
                <dd><button type="submit">登録</button></dd>
            </dl>
        </form>
    </section>
@endguest
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-sns.frame.basic>