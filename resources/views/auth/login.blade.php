<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'Tracking') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="assets/media/logos/logo-5.png"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/vendor/animate/animate.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/Login_v3/css/main.css') }}">

     <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100" 
            style="{{ rand(1,2)==1 ? 'background-image: url(public/Login_v3/images/bg-001.jpg)' : 'background-image: url(public/Login_v3/images/bg-002.jpg)' }}">
            <div class="wrap-login100" >
                {{-- <form class="login100-form validate-form"> --}}
                {{ Form::open(array('route' => 'login','class' => 'login100-form validate-form')) }}
                    <span class="login100-form-logo">
                        <img style="height: 150px" src="assets/media/logos/logo-5.png">
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in
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
                {{-- </form> --}}
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="{{ asset('public/Login_v3/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/Login_v3/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/Login_v3/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('public/Login_v3/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/Login_v3/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/Login_v3/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('public/Login_v3/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/Login_v3/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/Login_v3/js/main.js') }}"></script>
    @include('layouts.includes.scripts')
    @include('layouts.includes.partials.messages')
    

</body>
</html>