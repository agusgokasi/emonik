<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS-->
    {{-- <link href="{{ asset('sb2/vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('sb2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb2/css/sb-admin-2.min.css') }}" rel="stylesheet">



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

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <img src="{{ asset('img/unj.png')}}" height="45">
                <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
            </a>
            
            @include('layouts.sidebar')
        </ul>
        <!-- End of Sidebar -->
    
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest

                        @auth
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{strlen(Auth::user()->name) > 24 ? substr(Auth::user()->name,0,24)."...":Auth::user()->name}}</span>
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{strlen(Auth::user()->name) > 9 ? substr(Auth::user()->name,0,8)."...":Auth::user()->name}}</span> -->
                                <i class="fas fa-user-circle fa-2x"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('ProfileEdit' , ['id' => Auth::user()->id]) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth

                    </ul>
                </nav>
                <!-- End of Topbar -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                    <br>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; DEFAULT UNJ
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        &nbsp;&nbsp;&nbsp;Design by <a href="https://startbootstrap.com/themes/sb-admin-2/">SB ADMIN 2</a>
                    </span>
                </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('sb2/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('sb2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery.mask.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script> --}}

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Page level plugin JavaScript-->
    {{-- <script src="{{ asset('sb2/vendor/chart.js/Chart.min.js')}}"></script> --}}
    <script src="{{ asset('sb2/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('sb2/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb2/js/sb-admin-2.min.js')}}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{ asset('sb2/js/demo/datatables-demo.js')}}"></script>
    {{-- <script src="{{ asset('sb2/js/demo/chart-area-demo.js')}}"></script> --}}
    {{-- <script src="{{ asset('sb2/js/demo/chart-pie-demo.js')}}"></script> --}}
    @yield('add_js')

</body>

</html>