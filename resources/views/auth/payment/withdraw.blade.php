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
    .kcw_token_note{
        display: none;
        color:red;
        font-weight: bold;
    }
</style>
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    {{ Form::open(array('route' => 'user.payment.withdraw.save','class' => 'kt-form')) }}
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group{{ $errors->has('withdraw_type') ? ' has-error' : '' }}">
                    {!! Form::label('withdraw_type', 'Withdraw Type') !!}
                    <select class="form-control" id="withdraw_type" name="withdraw_type">
                        <option value="Block Chain">Block Chain</option>
                        <option value="Bank Account">Bank Account</option>
                        <option value="KCW Token">KCW Token</option>
                    </select>
                    <small class="text-danger">{{ $errors->first('withdraw_type') }}</small>
                </div>
                <div class="form-group{{ $errors->has('withdraw_amount') ? ' has-error' : '' }}">
                    {!! Form::label('withdraw_amount', 'Withdraw Amount') !!}
                    {!! Form::number('withdraw_amount', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter withdraw amount']) !!}
                    <small class="text-danger">{{ $errors->first('withdraw_amount') }}</small>
                    <span id="bank_account" class="bank_account_note">Your entered amount will be multiplied by Rs. {{App\Models\BonusValue::find(2)->value}}</span>
                    <span id="kcw_token" class="kcw_token_note">Rmaining Max Amount to buy tokens Rs. {{remainingTokenAmount()}} for tokens {{number_of_tokens()}}</span>
                </div>
            </div>
        </div><!--form-group-->
        <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Withdraw')</button>
    {{ Form::close() }}
</div>
<!-- end:: Content -->
@endsection
@section('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#withdraw_type" ).change(function() {
            if(this.value == "Bank Account")
                $( "#bank_account" ).show();
            else
                $( "#bank_account" ).hide();

            if(this.value == "KCW Token")
                $( "#kcw_token" ).show();
            else
                $( "#kcw_token" ).hide(); 

        });
    });
</script>
@endsection