@extends('layouts.app')

@section('title', __('Tracking App'))

@section('content')
<!-- begin:: Content -->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @lang('Users Management')
                <small class="text-muted">@lang('View')</small>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_overview">Details</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="kt_tabs_overview" role="tabpanel">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>@lang('Name')</th>
                                            <td>{{ $user->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('User Name')</th>
                                            <td>{{ $user->user_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Email')</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Blockchain Address')</th>
                                            <td>
                                                <span class="label label-warning label-pill label-inline mr-2">{{ $user->block_chain_address }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Status')</th>
                                            <td>@include('admin.user.includes.status', ['user' => $user])</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Confirmed')</th>
                                            <td>@include('admin.user.includes.confirm', ['user' => $user])</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Mobile')</th>
                                            <td>{{ $user->profile->mobile_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Date of Birth')</th>
                                            <td>{{ $user->profile->birthday }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('Street')</th>
                                            <td>{{ $user->profile->street }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('City')</th>
                                            <td>{{ $user->profile->city }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('Post Code')</th>
                                            <td>{{ $user->profile->post_code }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <h4 style="color:blue">Withdraw Requests</h4>
                        <h5 class="pull-right">Total Withdraw: ${{ $user->isCustomer() ? $user->totalWithdraw() : ''}}</h5><hr>
                        <table id="abc" class="table table-striped- table-bordered table-hover table-checkable display table-admin_tables">
                            <thead>
                                <tr>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentRequests->where('type',"withdraw") as $request)
                                <tr>
                                    <td>{{ $request->amount }}</td>
                                    <td>{{ $request->date }}</td>
                                    <td>{!! $request->status_label !!}</td>
                                    <td>
                                        @if($request->status==0)
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <a href="{{ route('admin.payment.withdraw.request.action', ['flag'=>encrypt(1),'id'=>encrypt($request->id),'user_id'=>encrypt($request->user->id)]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Accept</a>
                                            <a href="{{ route('admin.payment.withdraw.request.reject.form', ['flag'=>encrypt(2),'id'=>encrypt($request->id),'user_id'=>encrypt($request->user->id)]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="View">Reject</a>
                                        </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <h4 style="color:blue">Deposit Requests</h4>
                        <h5 class="pull-right">Total Deposit: ${{ $user->isCustomer() ? $user->totalDepositedAmount() : ''}}</h5>
                        <hr>
                        <table id="abc" class="table table-striped- table-bordered table-hover table-checkable display table-admin_tables">
                            <thead>
                                <tr>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Date')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentRequests
                                            ->where('type',"deposit")
                                            ->where('status',1) as $request)
                                <tr>
                                    <td>{{ $request->amount }}</td>
                                    <td>{{ $request->date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-primary" type="submit">@lang('Bsck to List')</a>
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection