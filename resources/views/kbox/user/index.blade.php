<x-kbox.frame.basic>
<x-slot name="title">user [K Box Syestem]</x-slot>
<x-slot name="id">user</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/kbox"><h1>K Box System</h1></a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/kbox/user"><h2>user</h2></a></x-slot>
<section id="form">
    <dl class="dl-flex">
        <dd>create new user</dd>
        <dd><button>input CSV file</button></dd>
        <dd><button>output CSV file</button></dd>
    </dl>
</section>
<section id="user">
    <dl id="dl-users">
        <dt>
            <dl class="dl-flex dl-user-header">
                <dd class="name">name</dd>
                <dd class="role">role</dd>
            </dl>
        </dt>
        @foreach ($users as $user)
            <dd>
                <dl class="dl-flex dl-user-content">
                    <dd class="name">
                        <ul>
                            <li>{{ isset($user->name)  ? $user->name->full_name() : null }}</li>
                            <li>{{ isset($user->name)  ? $user->name->full_name("kana") : null }}</li>
                            <li>{{ isset($user->name)  ? $user->name->full_name("en") : null }}</li>
                        </ul>
                        
                    </dd>
                    <dd class="role">
                        @if($user->category("kbox") && $user->category("kbox")->roles->isNotEmpty())
                            <ul>
                                @foreach ($user->category("kbox")->roles as $role)
                                    <li>{{ $role->role }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </dd>
                    <dd>
                        <dl class="dl-flex">
                            <dd><button type="button" onclick="location.href = '/kbox/user/{{ $user->id }}'">show</button></dd>
                        </dl>
                    </dd>
                </dl>
            </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-kbox.frame.basic>