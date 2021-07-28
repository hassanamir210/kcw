<div class="btn-group" role="group" aria-label="@lang('User Actions')">
    <a href="{{ route('admin.user.show', $user) }}" data-toggle="tooltip" data-placement="top" title="@lang('View')" class="btn btn-primary">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{ route('admin.user.edit', $user) }}" data-toggle="tooltip" data-placement="top" title="@lang('Edit')" class="btn btn-dark">
        <i class="fas fa-edit"></i>
    </a>

    <div class="dropdown" role="group">
        <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('More')
        </button>
        <div class="dropdown-menu" aria-labelledby="userActions">
            {{-- <a href="{{ route('admin.user.delete', $user->id) }}" class="dropdown-item">@lang('Delete')</a> --}}
            <a href="{{ route('admin.payment.deposit', ['id'=>$user->id, 'type'=>'add']) }}" class="dropdown-item">@lang('Deposit')</a>
            <a href="{{ route('admin.payment.deposit', ['id'=>$user->id, 'type'=>'sub']) }}" class="dropdown-item">@lang('Deduct')</a>
            <a href="{{ url('admin/user/level', ['id'=>$user->id]) }}" class="dropdown-item">@lang('Levels')</a>
        </div>
    </div>
</div>