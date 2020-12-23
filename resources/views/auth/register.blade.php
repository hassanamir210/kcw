@extends('layouts.main')

@section('content')
    <div class="wrap-login100" style="background: #716666ab;width: 750px" >
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 float-right">
                    <h4 style="color:white;">
                        Referred By: {{user_name(app('request')->input('ref'))}}
                    </h4>
                    <hr><br><br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter First Name">
                        <input autofocus for="first_name" id="first_name" type="text" placeholder="" class="input100 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="First Name"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Last Name">
                        <input autofocus for="last_name" id="last_name" type="text" placeholder="" class="input100 @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="Last Name"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Email">
                        <input autofocus for="email" id="email" type="email" placeholder="" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Mobile Number">
                        <input autofocus for="mobile_number" id="mobile_number" type="text" placeholder="" class="input100 @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="Mobile Number"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Birthday">
                        <input autofocus for="birthday" id="kt_datepicker_1" type="text" placeholder="" class="input100 @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="Birthday"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Street">
                        <input autofocus for="street" id="street" type="text" placeholder="" class="input100 @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="Street"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter City/State">
                        <input autofocus for="city" id="city" type="text" placeholder="" class="input100 @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="City/State"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Post Code">
                        <input autofocus for="post_code" id="post_code" type="text" placeholder="" class="input100 @error('post_code') is-invalid @enderror" name="post_code" value="{{ old('post_code') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="Post Code"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter User Name">
                        <input autofocus for="user_name" id="user_name" type="text" placeholder="" class="input100 @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="User Name"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter BTC Address">
                        <input autofocus for="btc_address" id="btc_address" type="text" placeholder="" class="input100 @error('btc_address') is-invalid @enderror" name="btc_address" value="{{ old('btc_address') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="BTC Address"></span>
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Password">
                        <input autofocus for="password" id="password" type="password" placeholder="" class="input100 @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="fasle">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-input100 validate-input" data-validate = "Enter Confirm Password">
                        <input autofocus for="password_confirmation" id="password-confirmation" type="password" placeholder="" class="input100 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required  autocomplete="new-password">
                        <span class="focus-input100" data-placeholder="Confirm Password"></span>
                    </div>
                </div>
            </div>

{{--             <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-11">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div> --}}
            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        if(text!='')
        {
            $("#first_name").focus();
            $("#last_name").focus();
            $("#email").focus();
            $("#mobile_number").focus();
            $("#kt_datepicker_1").focus();
            $("#street").focus();
            $("#city").focus();
            $("#post_code").focus();
            $("#user_name").focus();
            $("#btc_address").focus();
            $("#first_name").focus();
        }
    });
</script>
@endsection
