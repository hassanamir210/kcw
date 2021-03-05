@extends('layouts.app')

@section('title', __('Crypto World'))

@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    {{ Form::open(array('route' => array('profile.update', $user),'method' => 'PATCH','enctype'=>'multipart/form-data','class' => 'kt-form')) }}

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="first_name" class="col-md-6 col-form-label">@lang('First Name')</label>
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" autocomplete="name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="col-md-6 col-form-label">@lang('Last Name')</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" autocomplete="name" autofocus>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="mobile_number" class="col-md-6 col-form-label">@lang('Mobile Number')</label>
                    <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ $user->profile->mobile_number }}" autocomplete="name" autofocus>
                    @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="street" class="col-md-6 col-form-label">@lang('Street')</label>
                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $user->profile->street }}" autocomplete="name" autofocus>
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->


            <div class="form-group row">
                <div class="col-md-6">
                    <label for="street" class="col-md-6 col-form-label">@lang('City/State')</label>
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->profile->city }}" autocomplete="name" autofocus>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="post_code" class="col-md-6 col-form-label">@lang('Post Code')</label>
                    <input id="post_code" type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ $user->profile->post_code }}" autocomplete="name" autofocus>
                    @error('post_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->


            <div class="form-group row">
                
                <div class="col-md-6">
                    <label for="block_chain_address" class="col-md-6 col-form-label">@lang('Block Chain Address')</label>
                    <input id="block_chain_address" type="text" class="form-control @error('block_chain_address') is-invalid @enderror" name="block_chain_address" value="{{ $user->block_chain_address }}" autocomplete="name" autofocus>
                    @error('block_chain_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->
            <div class="form-group row">
                
                <div class="col-md-12">
                    <label for="id_front_image" class="col-md-6 col-form-label">@lang('ID Front Image')</label>
                    @if($user->id_front_image!=null)
                    <img src="{{url('storage/app/public/images/'.$user->id_front_image)}}" style="    width: 100%;height: 260px;">
                    @endif
                    <input id="id_front_image" type="file" class="form-control @error('id_front_image') is-invalid @enderror" name="id_front_image" value="{{ $user->id_front_image }}" autocomplete="name" autofocus>
                    @error('id_front_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="id_back_image" class="col-md-6 col-form-label">@lang('ID Back Image')</label>
                    @if($user->id_back_image!=null)
                    <img src="{{url('storage/app/public/images/'.$user->id_back_image)}}" style="    width: 100%;height: 260px;">
                    @endif
                    <input id="id_back_image" type="file" class="form-control @error('id_back_image') is-invalid @enderror" name="id_back_image" value="{{ $user->id_back_image }}" autocomplete="name" autofocus>
                    @error('id_back_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><!--form-group-->

            <div class="form-group row">
                
                <div class="col-md-12">
                    <label for="passport_front_image" class="col-md-6 col-form-label">@lang('Passport Front Image')</label>
                    @if($user->passport_front_image!=null)
                    <img src="{{url('storage/app/public/images/'.$user->passport_front_image)}}" style="    width: 100%;height: 260px;">
                    @endif
                    <input id="passport_front_image" type="file" class="form-control @error('passport_front_image') is-invalid @enderror" name="passport_front_image" value="{{ $user->passport_front_image }}" autocomplete="name" autofocus>
                    @error('passport_front_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="passport_back_image" class="col-md-6 col-form-label">@lang('Passport Back Image')</label>
                    @if($user->passport_back_image!=null)
                    <img src="{{url('storage/app/public/images/'.$user->passport_back_image)}}" style="    width: 100%;height: 260px;">
                    @endif
                    <input id="passport_back_image" type="file" class="form-control @error('passport_back_image') is-invalid @enderror" name="passport_back_image" value="{{ $user->passport_back_image }}" autocomplete="name" autofocus>
                    @error('passport_back_image')
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