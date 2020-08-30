@extends('layouts.app')

@section('title', __('Crypto World'))

@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    {{ Form::open(array('route' => 'admin.payment.withdraw.request.reject','class' => 'kt-form')) }}
        <div class="form-group row">
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                    {!! Form::label('reason', 'Rejection Reason') !!}
                    {!! Form::textarea('reason', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter reason for rejection']) !!}
                    <small class="text-danger">{{ $errors->first('reason') }}</small>
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <input type="hidden" name="flag" value="{{$flag}}">
                </div>
            </div>
        </div><!--form-group-->
        <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Confirm')</button>
    {{ Form::close() }}
</div>
<!-- end:: Content -->
@endsection
