@extends('layouts.app')

@section('title', __('Tracking App'))

@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    {{ Form::open(array('route' => 'admin.payment.deposit.store','class' => 'kt-form')) }}
    <div class="form-group row">
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('deposit_amount') ? ' has-error' : '' }}">
                {!! Form::hidden('id', encrypt($id)) !!}
                {!! Form::hidden('type', encrypt($type)) !!}
                @if($type == "add")
                {!! Form::label('deposit_amount', 'Deposit Amount') !!}
                @else
                {!! Form::label('deduct_amount', 'Deduct Amount') !!}
                @endif
                {!! Form::number('deposit_amount', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter deposit amount']) !!}
                <small class="text-danger">{{ $errors->first('deposit_amount') }}</small>
            </div>
        </div>
    </div><!--form-group-->
    <button class="btn btn-sm btn-primary float-right" type="submit">
        @if($type == "add")
        @lang('Deposit')
        @else
        @lang('Deduct')
        @endif
    </button>
    {{ Form::close() }}
</div>
<!-- end:: Content -->
@endsection
