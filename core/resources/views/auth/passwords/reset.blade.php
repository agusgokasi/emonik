@extends('layouts.app1')

@section('content')
<div class="limiter">
        <div class="container-login100" >
            <div class="wrap-login100" >
                <div class="login100-pic js-tilt"  data-tilt>
                    <img src="{{ asset('Login/images/logo-unj.png') }}" alt="IMG">
                    <h5 style="text-align:center"><strong>E-Monitoring Keuangan Fakultas MIPA UNJ</strong></h5>
                </div>
                <form class="login100-form" method="POST" action="{{ route('password.update') }}">
                    {{ csrf_field() }}
                    <span class="login100-form-title">
                        Reset Password
                    </span>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="wrap-input100  ">
                        <input class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('email')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="wrap-input100  ">
                        <input class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="New Password" id="password" type="password" name="password" required autocomplete="new-password" autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="wrap-input100 ">
                        <input class="input100" type="password" placeholder="Confirm New Password" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Reset Password
                        </button>
                    </div>

                    <div class="text-center p-t-12">

                    </div>

                    <div class="text-center p-t-140">
                    <footer class="sticky-footer">
                        <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span style="color:#e25555"><i class="fa fa-heart" aria-hidden="true"></i></span> Development by DEFAULT UNJ<br>
                            Design by <a href="https://colorlib.com/wp/template/login-form-v1/">Colorlib</a>
                        </div>
                        </div>
                    </footer>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
