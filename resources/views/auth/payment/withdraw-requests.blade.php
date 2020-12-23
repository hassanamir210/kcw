@extends('layouts.app')

@section('title', __('Crypto World'))

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <br>
        <div class="container" style="text-align: center;">
            <a href="{{ route('admin.payment.withdraw.requests',[encrypt($type),'w']) }}" type="button" class="btn btn-primary">7 Days</a>
            <a href="{{ route('admin.payment.withdraw.requests',[encrypt($type),'m']) }}" type="button" class="btn btn-warning">30 Days </a>
            <a href="{{ route('admin.payment.withdraw.requests',[encrypt($type),'y']) }}" type="button" class="btn btn-success">12 Months</a>
        </div>
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    User Payment Withdraw Requests ({{$type}})
                </h3>
            </div>
            <div class="float-right">
                <small class="text-muted font-17">Total: 
                    <b>
                    @if($type!="Block Chain")
                        Rs. {{sumInRupee($withdrawRequests)}}
                    @else
                        ${{$withdrawRequests->sum('amount')}}
                    @endif
                    </b></small><br>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="users-table-container">
                @include('auth.payment.withdraw-requests-table')
            </div>
            <div class="pagination" style="margin-left:auto">
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection
