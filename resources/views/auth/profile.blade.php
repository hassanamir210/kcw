@extends('layouts.app')

@section('title', __('Crypto World'))

@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    {{ Form::open(array('route' => array('profile.update', $user),'method' => 'PATCH','class' => 'kt-form')) }}

            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="first_name" class="col-form-label">@lang('First Name')</label>
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" autocomplete="name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="last_name" class="col-form-label">@lang('Last Name')</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" autocomplete="name" autofocus>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->

            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="mobile_number" class="col-form-label">@lang('Mobile Number')</label>
                    <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ $user->profile->mobile_number }}" autocomplete="name" autofocus>
                    @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="street" class="col-form-label">@lang('Street')</label>
                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $user->profile->street }}" autocomplete="name" autofocus>
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->


            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="street" class="col-form-label">@lang('City/State')</label>
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->profile->city }}" autocomplete="name" autofocus>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="post_code" class="col-form-label">@lang('Post Code')</label>
                    <input id="post_code" type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ $user->profile->post_code }}" autocomplete="name" autofocus>
                    @error('post_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->

            <hr>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="block_chain_address" class="col-form-label">@lang('Block Chain Address')</label>
                    <input id="block_chain_address" type="text" class="form-control @error('block_chain_address') is-invalid @enderror" name="block_chain_address" value="{{ $user->block_chain_address }}" autocomplete="name" autofocus>
                    @error('block_chain_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->
            <hr>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="bank_account_no" class="col-form-label">@lang('Bank Account No')</label>
                    <input id="bank_account_no" type="text" class="form-control @error('bank_account_no') is-invalid @enderror" name="bank_account_no" value="{{ $user->bank_account_no }}" autocomplete="name" autofocus>
                    @error('bank_account_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="bank_name" class="col-form-label">@lang('Bank Name')</label>
                    <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ $user->bank_name }}" autocomplete="name" autofocus>
                    @error('bank_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="bank_user_title" class="col-form-label">@lang('Bank User Title')</label>
                    <input id="bank_user_title" type="text" class="form-control @error('bank_user_title') is-invalid @enderror" name="bank_user_title" value="{{ $user->bank_user_title }}" autocomplete="name" autofocus>
                    @error('bank_user_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="bank_branch_code" class="col-form-label">@lang('Bank Branch Code')</label>
                    <input id="bank_branch_code" type="text" class="form-control @error('bank_branch_code') is-invalid @enderror" name="bank_branch_code" value="{{ $user->bank_branch_code }}" autocomplete="name" autofocus>
                    @error('bank_branch_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-danger mr-2 float-right" type="submit">@lang('Cancel')</a>
    {{ Form::close() }}
</div>
<!-- end:: Content -->
@endsection