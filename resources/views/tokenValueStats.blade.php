@extends('layouts.app')

@section('title', __('Crypto World'))
<style type="text/css">
    span{
        margin-right: 15px !important;
    }
    .bank_account_note{
        display: none;
        color:red;
        font-weight: bold;
    }
</style>
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="container">
        {!! $tokensChart->container() !!}
    </div>
    <br><br>
    <div class="container" style="text-align: center;">
        @if(auth()->user()->id!=1)
            <a href="{{url('/user/token-value-stats/w')}}" type="button" class="btn btn-primary">7 Days</a>
            <a href="{{url('/user/token-value-stats/m')}}" type="button" class="btn btn-warning">30 Days </a>
            <a href="{{url('/user/token-value-stats/y')}}" type="button" class="btn btn-success">12 Months</a>
        @else
            <a href="{{url('/admin/token-value-stats/w')}}" type="button" class="btn btn-primary">7 Days</a>
            <a href="{{url('/admin/token-value-stats/m')}}" type="button" class="btn btn-warning">30 Days </a>
            <a href="{{url('/admin/token-value-stats/y')}}" type="button" class="btn btn-success">12 Months</a>
        @endif
    </div>
</div>
<!-- end:: Content -->
@endsection
@section('scripts')
    {!! $tokensChart->script() !!}
@endsection