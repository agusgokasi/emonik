<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('logo.png') }}" alt="">
    <title>E-Monitoring Keuangan Fakultas MIPA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <!-- <link rel="icon" type="image/png" href="Login/images/icons/favicon.ico"/> -->
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Login/vendor/animate/animate.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Login/css/util.css">
    <link rel="stylesheet" type="text/css" href="Login/css/main.css">


<!--===============================================================================================-->
</head>
<body>
    <div class="limiter">
        <div class="container-login100" >
            <div class="wrap-login100" >
                <div class="login100-pic js-tilt"  data-tilt>
                    <img src="Login/images/logo-unj.png" alt="IMG">
                    <h5 style="text-align:center"><strong>E-Monitoring Keuangan Fakultas MIPA</strong></h5>
                </div>
                <form class="login100-form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <span class="login100-form-title">
                        Masuk Akun
                    </span>

                    <div class="wrap-input100  ">
                        <input class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" id="email" type="email" name="email" required autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100  ">
                        <input class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Password" id="password" type="password" name="password" required autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Ingat Saya') }}</label>
                            </div>
                        </div>
                    </div>
                    Lupa password?
                    @if (Route::has('password.request'))
                        <a style="color:cornflowerblue" href="{{ route('password.request') }}"><strong>{{ __('Reset di sini') }}</strong></a>
                    @endif
                    <br>
                    {{--<!-- Belum pernah mendaftar?
                    <a style="color:cornflowerblue" href="{{ route('register') }}"><strong>Daftar di sini</strong></a>
                    <br> -->--}}


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Masuk
                        </button>
                    </div>
                    <!-- <div class="container-login100-form-btn">
                        <a class="login100-form-btn" style="background-color:black" href="{{ url('/') }}">
                            Batal
                        </a>
                    </div> -->

                    <div class="text-center p-t-12">

                    </div>

                    <div class="text-center p-t-140">
                    <footer class="sticky-footer">
                        <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span style="color:#e25555"><i class="fa fa-heart" aria-hidden="true"></i></span> Development by DEFAULT UNJ
                        </div>
                        </div>
                    </footer>
                    </div>

                </form>
            </div>
        </div>
    </div>




<!--===============================================================================================-->
    <script src="Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="Login/vendor/bootstrap/js/popper.js"></script>
    <script src="Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="Login/vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<!--===============================================================================================-->
    <script src="Login/js/main.js"></script>


</body>
</html>
