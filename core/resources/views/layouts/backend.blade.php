<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('sb/vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb/vendors/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('sb/vendors/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb/css/sb-admin.css') }}" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/unj.png') }}">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js')}}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
       #loader{
       visibility:hidden;
       }
    </style>
</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="{{ url('/home') }}">
            {{-- <img src="http://www.unj.ac.id/wp-content/uploads/2018/05/fav.png" height="45"> --}}
            <img src="{{ asset('img/unj.png')}}" height="45">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="btn btn-link btn-sm text-white" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-nav ml-auto">
        </ul>

        <!-- Navbar link : profile, logout, -->
        <ul class="navbar-nav mr mr-md-0">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fas fa-user-circle"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <small><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>

                    <a class="dropdown-item" href="{{ route('ProfileEdit' , ['id' => Auth::user()->id]) }}">Profile</a>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a></small>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

            @endguest
        </ul>
    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar') 
        {{-- content --}}
        <div id="content-wrapper">

            <div class="container-fluid">
                <!-- Page Content -->
                @yield('content')
                <br>
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © DEFAULT UNJ <script>
                        document.write(new Date().getFullYear())
                    </script></span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('sb/vendors/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('sb/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery.mask.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script> --}}

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb/vendors/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('sb/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('sb/vendors/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('sb/vendors/datatables/dataTables.bootstrap4.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb/js/sb-admin.min.js')}}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{ asset('sb/js/demo/datatables-demo.js')}}"></script>
    <script src="{{ asset('sb/js/demo/chart-area-demo.js')}}"></script>
    @yield('add_js')

</body>

</html>