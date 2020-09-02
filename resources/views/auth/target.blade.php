@extends('layouts.app')

@section('title', __('Crypto World'))

@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="pull-right" style="margin-top:10px">
                <small class="text-muted font-17" >20 August - 31 December</small>
            </div>
            <div class="pull-right" style="margin-top:10px">
                <small class="text-muted font-17" >Total Investment <b>${{$sum}}</b></small>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="users-table-container">
                <table class="table table-striped- table-bordered table-hover table-checkable table-data_table" >
                    <thead>
                        <tr>
                            <th>@lang('Date')</th>
                            <th>@lang('User Name')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Investment')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><span class="badge badge-secondary">{{ $user->created_at->toFormattedDateString() }}</span></td> 
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->name }}</td>
                            <td><span class="badge badge-success">{{ $user->email }}</span></td>
                            <td><span class="badge badge-primary">${{ $user->totalDeposit() }}</span></td>
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