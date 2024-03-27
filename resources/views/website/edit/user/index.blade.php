<x-website.frame.edit>
<x-slot name="title">user</x-slot>
<x-slot name="id">user</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2">user</x-slot>
<section id="index">
    <dl id="dl-user-index">
        <dt>
            <dl class="dl-flex dl-user-index-header">
                <dd class="dd-user-index-id">id</dd>
                <dd class="dd-user-index-email">email</dd>
                <dd class="dd-user-index-name">name</dd>
                <dd class="dd-user-index-birthday">birthday</dd>
                <dd class="dd-user-index-category">category</dd>
                <dd class="dd-user-index-button"></dd>
            </dl>
        </dt>
        @foreach ($users as $user)
            <dd>
                <dl class="dl-flex dl-user-index-body" style="align-items: center;">
                    <dd class="dd-user-index-id">{{ $user->id }}</dt>
                    <dd class="dd-user-index-email">{{ $user->email }}</dd>
                    <dd class="dd-user-index-name">{{ isset($user->name) ? $user->name->full_name() : null }}</dd>
                    <dd class="dd-user-index-birthday">{{ isset($user->birthday) ? $user->birthday->birthday() : null }}</dd>
                    <dd class="dd-user-index-category">
                        @isset($user->subdirectory_roles)
                            <ul>
                                @foreach ($user->subdirectory_roles->unique("subdirectory_id") as $subdirectory_role)
                                    <li>{{ $subdirectory_role->subdirectory->value }}</li>
                                @endforeach
                            </ul>
                        @endisset
                    </dd>
                    <dd class="dd-user-index-button">
                        <dl class="dl-flex">
                            <dd><button onclick="location.href = '/edit/user/{{ $user->id }}'">show</button></dd>
                            <dd><button onclick="location.href = '/edit/user/{{ $user->id }}/delete'">delete</button></dd>
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
</x-website.frame.edit>