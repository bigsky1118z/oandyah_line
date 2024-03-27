@php
    use App\Models\Api\LineApiUser;
    $users  =   LineApiUser::whereChannelName($channel->channel_name)->get();
@endphp
<x-admin.api.line.frame.modal :id="$id" type="option">
<form>
    @foreach ($users as $user)
    <dl class="dl-flex-center">
        <dd class="select-dd">
            {{-- <label for="endpoint-push-{{ $user->id }}"> --}}
                <input type="checkbox" class="addPush" name="push[{{ $user->id }}]" value="{{ $user->line_user_id }}" data-nickname="{{ $user->nickname() }}">
                {{-- {{ $user->nickname() }} --}}
            {{-- </label> --}}
        </dd>
        <dd class="content-dd"></dd>
    </dl>
    @endforeach
</form>
</x-admin.api.line.frame.modal>