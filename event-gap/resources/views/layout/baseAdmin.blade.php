<!DOCTYPE html>
<html lang="en">

<head>
    <title>Event Gap</title>
    <link rel="icon" href="{{ asset('images/logo.png')}}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/templatemo-digital-trend.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/aos.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style2-0.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    @yield('embedcss')

</head>

<body style="color :black">
    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand w-50" href="{{ url('/admin-page/dashboard')}}">
                <img src="{{ asset('images/2.0/logo-perusahaan.png')}}" alt="logo" srcset="" class="img-fluid w-50 ">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a href="{{ url('/admin-page/dashboard-verifikasi') }}" class="nav-link c-green">Verifikasi User</a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ url('/admin-page/dashboard') }}" class="nav-link c-green">Event Partner Data</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link c-grey">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="site-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 mx-lg-auto col-md-8 col-10">
                    <h1 class="text-white" data-aos="fade-up" data-aos-delay="100">Kami membantu anda membuat
                        <strong>Event</strong> terbaik.</h1>
                </div>

                <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="my-4">Contact Info</h4>

                    <p class="mb-1">
                        <i class="fa fa-phone mr-2 footer-icon"></i>
                        +62 812 070 4224
                    </p>

                    <p>
                        <a href="#">
                            <i class="fa fa-envelope mr-2 footer-icon"></i>
                            EventGap@company.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="300">
                    <h4 class="my-4">Our Studio</h4>

                    <p class="mb-1">
                        <i class="fa fa-home mr-2 footer-icon"></i>
                        Jl. Danau Ranau, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139
                    </p>
                </div>

                <div class="col-lg-4 mx-lg-auto text-center col-md-8 col-12" data-aos="fade-up" data-aos-delay="400">
                    <p class="copyright-text">Copyright &copy; 2020 EventGap
                </div>

                <div class="col-lg-4 mx-lg-auto col-md-6 col-12" data-aos="fade-up" data-aos-delay="500">

                    <ul class="footer-link">
                        <li><a href="#">Stories</a></li>
                        <li><a href="#">Work with us</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 mx-lg-auto col-md-6 col-12" data-aos="fade-up" data-aos-delay="600">
                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-instagram"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-dribbble"></a></li>
                        <li><a href="#" class="fa fa-behance"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    @yield('modal')
    @yield('modal2')

    <!-- SCRIPTS -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/aos.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/smoothscroll.js')}}"></script>
    <script src="{{ asset('js/custom.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    @yield('embedjs')
    @yield('js')
</body>

</html>
