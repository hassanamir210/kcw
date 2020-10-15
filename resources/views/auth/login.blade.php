@extends('layouts.main')
@section('content')
    <div class="wrap-login100" >    
        {{-- <form class="login100-form validate-form"> --}}
        {{ Form::open(array('route' => 'login','class' => 'login100-form validate-form')) }}
            <span class="login100-form-logo">
                <img style="height: 150px" src="assets/media/logos/logo-5.png">
            </span>

            <span class="login100-form-title p-b-34 p-t-27">
                {{-- Log in
                <br> --}}
                <i>You are looking gorgeous today!</i>

            </span>

            <div class="wrap-input100 validate-input" data-validate = "Enter username">
                <input id="user_name" type="text" placeholder="Username" class="input100 @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="email">
                <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
                {{-- <input class="input100" type="password" name="pass" placeholder="Password"> --}}
                <input id="password" type="password" placeholder="Password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            {{-- <div class="contact100-form-checkbox">
                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                <label class="label-checkbox100" for="ckb1">
                    Remember me
                </label>
            </div> --}}

            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Login
                </button>
            </div>
            <div class="text-right p-t-90">
                <a href="{{ route('password.request') }}" class="txt-1" style="color:#fff">Forget Password ?</a>
            </div>

        {{ Form::close() }}
    </div>
@endsection