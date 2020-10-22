@extends('layouts.app1')

@section('content')
    <div class="limiter">
        <div class="container-login100" >
            <div class="wrap-login100" >
                <div class="login100-pic js-tilt"  data-tilt>
                    <img src="{{ asset('Login/images/logo-unj.png') }}" alt="IMG">
                    <a href="{{ route('home') }}"><h5  style="text-align:center;"><strong>E-Monitoring Keuangan Fakultas MIPA UNJ</strong></h5></a>
                </div>
                <form class="login100-form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <span class="login100-form-title">
                        Reset Password
                    </span>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="wrap-input100">
                        <input class="input100 {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Reset password
                        </button>
                    </div>
                    <!-- <div class="container-login101-form-btn">
                        <a class="login101-form-btn" href="{{ route('login') }}">
                            Kembali
                        </a>
                    </div> -->
                    <div class="text-center p-t-12">
                        <span class="txt1">
                            
                        </span>
                        <a style="color:cornflowerblue" class="txt2" href="{{ route('login') }}">
                            <i class="fa fa-arrow-left m-l-5" aria-hidden="true"> Kembali ke halaman login</i>
                        </a>
                    </div>

                    <div class="text-center p-t-140">
                    {{-- <footer class="sticky-footer">
                        <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span style="color:#e25555"><i class="fa fa-heart" aria-hidden="true"></i></span> Development by DEFAULT UNJ <br>
                            Design by <a href="https://colorlib.com/wp/template/login-form-v1/">Colorlib</a>
                        </div>
                        </div>
                    </footer> --}}
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection