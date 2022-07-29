<!doctype html>
<html class="no-js bg-black" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ngopibareng.id
    </title>
    <link rel="icon" href="{{url('')}}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{url('css/app.css')}}"> --}}
    <link rel="stylesheet" href="{{url('assets/admin/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/ionicons/dist/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/icon-kit/dist/css/iconkit.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/summernote/dist/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/mohithg-switchery/dist/switchery.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/dist/css/theme.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/src/js/vendor/modernizr-2.8.3.min.js')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{url('assets/admin/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet"
        href="{{url('assets/admin/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/weather-icons/css/weather-icons.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/c3/c3.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/owl.carousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/owl.carousel/dist/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/transition.css@v2.0.0/dist/transition.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/transition.css@v2.0.0/dist/transition.min.css">
    <link rel="stylesheet" href="{{url('assets/admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/admin/dist/css/custom.css')}}">

    @yield('css')
</head>

<body>

    @yield('header')

    <div class="wrapper">
        <header class="header-top" header-theme="light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="top-menu d-flex align-items-center"><button type="button"
                            class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button></div>
                    <div class="top-menu d-flex align-items-center">
                        {{-- <button type="button" id="navbar-fullscreen"
                            class="nav-link"><i class="ik ik-maximize"></i></button> --}}
                        <div class="dropdown"><a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                                    src="{{url('assets/admin/img/user.png')}}" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="ik ik-user dropdown-icon"></i>Account</a>
                                    <button class="dropdown-item" href="#">
                                        <i class="ik ik-power dropdown-icon"></i>Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrap">
            <div id="btn-sidebar" class="app-sidebar colored">
                <div class="sidebar-header"><a class="header-brand" href="index.html">
                        <div class="logo-img">
                            <img src="https://www.ngopibareng.id/img/logongopibareng.png" alt="" style="width: 700%;">
                        </div><span class="text"></span>
                    </a></div>
                <div class="sidebar-content">
                    <div class="nav-container">
                        <nav id="main-menu-navigation" class="navigation-main">
                            <div
                                class="nav-item {{Route::is('users.index') || Route::is('users.create') || Route::is('users.edit') || Route::is('users.destroy') ? 'active' : ''}}">
                                <a href="{{route('users.index')}}" style="color:#0e0e0e"><i
                                        class="ik ik-menu"></i><span>Users</span></a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    @yield('iconHeader')
                                    <div class="d-inline">
                                        <h5>@yield('titleHeader')</h5>
                                        <span>@yield('subtitleHeader')</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <i class="ik ik-home"></i><a href="{{route('dashboard')}}"> Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb')</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    @yield('content-wrapper')
                </div>
            </div>

            <div class='footer-buttons'>
                @yield('fixedButton')
            </div>

            <footer class="footer">
                <div class="w-100 clearfix"><span class="text-center text-sm-left d-md-inline-block">Copyright ©
                        2022 </span></div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write(
            '<script src="{{url("assets/admin/src/js/vendor/jquery-3.3.1.min.js")}}"><\/script>')

    </script>
    <script src="{{url('assets/admin/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <script src="{{url('assets/admin/plugins/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/jquery.repeater/jquery.repeater.min.js')}}"></script>

    <script src="{{url('assets/admin/plugins/screenfull/dist/screenfull.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
    </script>

    <script src="{{url('assets/admin/plugins/moment/moment.js')}}"></script>
    <script src="{{url('assets/admin/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js')}}">
    </script>
    <script src="{{url('assets/admin/plugins/d3/dist/d3.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/c3/c3.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/amcharts/amcharts.js')}}"></script>
    <script src="{{url('assets/admin/plugins/amcharts/gauge.js')}}"></script>
    <script src="{{url('assets/admin/plugins/amcharts/serial.js')}}"></script>
    <script src="{{url('assets/admin/plugins/amcharts/light.js')}}"></script>
    <script src="{{url('assets/admin/plugins/amcharts/animate.min.js')}}"></script>
    <script src="{{url('assets/admin/plugins/amcharts/pie.js')}}"></script>

    <script src="{{url('assets/admin/js/charts.js')}}"></script>
    <script src="{{url('assets/admin/js/alerts.js')}}"></script>
    <script src="{{url('assets/admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('.mobile-nav-toggle').click(function () {
                $('#btn-sidebar').removeClass('hide-sidebar')
            })
        })
    </script>

    @yield('footer')

</body>

</html>
