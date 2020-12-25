@extends('layouts.app')

@section('title', __('Crypto World'))

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Token Redeem
                </h3>
            </div>
            <div class="float-right">
                {{-- <small class="text-muted font-17">Total ROI: <b>${{ auth()->user()->getTotalRoi() }}</b></small><br> --}}
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="users-table-container">
                <table class="table table-striped- table-bordered table-hover table-checkable table-data_table" >
                    <thead>
                        <tr>
                            <th>@lang('Date')</th>
                            <th>@lang('Username')</th>
                            <th>@lang('Tokens')</th>
                            <th>@lang('Value')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($redeems as $redeem)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($redeem->created_at)->format('Y-m-d') }}</td>
                            <td>{{ $redeem->user->user_name }}</td>
                            <td>${{ $redeem->tokens }}</td>
                            <td>${{ $redeem->value }}</td>
                            <td>
                                @if(!$redeem->status)
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-success">Added</span>
                                @endif
                            </td>
                            <td>
                                @if(!$redeem->status)
                                    <a href="{{url('admin/add/redeem/'.$redeem->id)}}" class="btn btn-primary">Add</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination" style="margin-left:auto">
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection
