@extends('layouts.app')

@section('title', __('Tracking App'))

@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    {{ Form::open(array('route' => 'admin.payment.point.store','class' => 'kt-form')) }}
        <div class="form-group row">
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
                    {!! Form::hidden('id', encrypt($id)) !!}
                    {!! Form::label('points', 'Points') !!}
                    {!! Form::number('points', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter deposit amount']) !!}
                    <small class="text-danger">{{ $errors->first('points') }}</small>
                </div>
            </div>
        </div><!--form-group-->
        <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Add')</button>
    {{ Form::close() }}
</div>
<!-- end:: Content -->
@endsection
