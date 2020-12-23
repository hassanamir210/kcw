<table class="table table-striped- table-bordered table-hover table-checkable table-admin_tables" >
    <thead>
        <tr>
            <th>@lang('Name')</th>
            <th>@lang('Username')</th>
            <th>@lang('Email')</th>
            <th>@lang('Amount')</th>
            <th>@lang('Address')</th>
            <th>@lang('Date')</th>
            <th>@lang('Status')</th>
            <th>@lang('Action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($withdrawRequests as $request)
        <tr>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->user->user_name }}</td>
            <td>{{ $request->user->email }}</td>
            <td>
                ${{ $request->amount }}
                @if($request->withdraw_type!="Block Chain")
                    (Rs.{{ $request->amount * $request->dollar_value }})
                @endif
            </td>
            <td>${{ $request->user->block_chain_address }}</td>
            <td>{{ $request->date }}</td>
            <td>{!! $request->status_label !!}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a href="{{ route('admin.payment.withdraw.request.action', ['flag'=>encrypt(1),'id'=>encrypt($request->id),'user_id'=>encrypt($request->user->id)]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Accept</a>
                    @if($request->withdraw_type!="KCW Token")
                        <a href="{{ route('admin.payment.withdraw.request.reject.form', ['flag'=>encrypt(2),'id'=>encrypt($request->id),'user_id'=>encrypt($request->user->id)]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="View">Reject</a>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>