<x-kbox.frame.basic>
<x-slot name="title">K Box Syestem</x-slot>
<x-slot name="id">top</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
@guest
    <section id="login"><x-kbox.main.form.login /></section>
@endguest
@auth
    <x-slot name="header"></x-slot>
    <section id="top">
        <ul>
            <li><a href="/kbox/user">user</a></li>
            <li><a href="/kbox/company">company</a></li>
            <li><a href="/kbox/sheet">sheet</a></li>
            <li><a href="/kbox/product">product</a></li>
        </ul>
    </section>
    <x-slot name="hidden"></x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="script"></x-slot>
@endauth
</x-kbox.frame.basic>