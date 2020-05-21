<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>UNY Cartesion</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('landing/images/cartesion-sm.png') }} " type="image/png">

    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/css/magnific-popup.css') }}">

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/css/slick.css') }}">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/css/LineIcons.css') }}">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/css/default.css') }}">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="{{ asset('landing/css/main.css') }}" rel="stylesheet" />

    <!--====== Extension CSS =======-->
    <link href="{{asset('css/extension/select2.min.css')}}" rel="stylesheet" />



</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area bg-primary">
        <div class="container">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg ">


                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo"
                            aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav  f-left">
                                <li class="nav-item active">
                                    <a class="page-scroll" href="{{url('/#home')}}">
                                        <img class="cartesionlogo" src="{{ asset('landing/images/logo-alt-white.png') }}"/>
                                    </a>
                                </li>
                                 <li class="nav-item"><a class="page-scroll" href="{{url('/#tentangUnyCartesion')}}">Tentang</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/#kategorilomba')}}">Kategori Lomba</a>
                                </li>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/#berita')}}">Berita</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/#kodePT')}}">Kode PT</a>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/#faq')}}">FAQ</a></li>
                                
                                @if(Auth::user())
                                    @if(Auth::user()->role == "Mahasiswa")
                                    <li class="nav-item"><a class="hideonbig page-scroll" href="{{ route('teams.index') }}">Dashboard</a></li>
                                    @else
                                    <li class="nav-item"><a class="hideonbig page-scroll" href="{{ route('admin.index') }}">Dashboard</a></li>
                                    @endif
                                @else
                                    <li class="nav-item"><a class="hideonbig page-scroll" href="{{ route('admin.index') }}">Unduh Panduan</a></li>
                                    <li class="nav-item"><a class="hideonbig page-scroll" href="{{ url('/login') }}">Masuk</a></li>
                                @endif
                            </ul>
                        </div>

                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                @if(Auth::user())
                                    @if(Auth::user()->role == "Mahasiswa")
                                    <li><a class="solid" href="{{ route('teams.index') }}">Dashboard</a></li>
                                    @else
                                    <li><a class="solid" href="{{ route('admin.index') }}">Dashboard</a></li>
                                    @endif
                                @else
                                    <li><a class="solid" href="{{ route('admin.index') }}">Unduh Panduan</a></li>
                                    <li><a class="solid" href="{{ url('/login') }}">Masuk</a></li>
                                @endif
                            </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== NAVBAR TWO PART ENDS ======-->

    <!--====== KETERANGAN PART START ======-->


    <!--====== KETERANGAN PART ENDS ======-->
    <section id="detailBerita" class="detailBerita-area">
        <div class="container mt-120">
            @foreach($detail as $d)
            <div>
                <h1 class=" text-center mt-60 ">{{$d->judul}}</h1>
            </div>
            <div class="team-image">
                <img class="mx-auto d-block" src="{{ asset('img'.'/'.'theme'.'/'.$d->gambar) }}" alt="Berita">
            </div>
            <div class="container">
                <p>{{$d->keterangan}}</p> <!-- row -->
            </div>
            @endforeach
            <!-- container -->
    </section>
    <br><br>
    <!--====== FOOTER PART START ======-->

    <section class="footer-area footer-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-logo text-center">
                        <a class="mt-30" href="https://cartesion.uny.ac.id">
                            <img src="{{ asset('landing/images/logo-unycartesion.png') }}" alt="">
                        </a>
                    </div> <!-- footer logo -->
                    <ul class="social text-center mt-40">
                        <li><a href="https://cartesion.uny.ac.id"><i><img src="/landing/images/globe.svg" width="25px" height="25px" alt="website"></i></a></li>
                        <li><a href="https://www.instagram.com/uny_official/?hl=id"><i><img src="/landing/images/instagram.svg" width="25px" height="25px" alt="website"></i></a></li>
                    </ul> <!-- social -->
                    {{-- <div class="footer-support text-center">
                    </div> --}}
                    <!-- <div class="copyright text-center mt-35">
                        <p class="text">Made with <i class="lni lni-heart-filled"></i> by Infinite UNY </p>
                    </div>  -->
                    <!--  copyright -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== PART START ======-->

    <!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">
                    
                </div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->




    <!--====== Jquery js ======-->
    <script src="{{ asset('landing/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('landing/js/vendor/modernizr-3.7.1.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('landing/js/popper.min.js') }}"></script>
    <script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="{{ asset('landing/js/slick.min.js') }}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('landing/js/jquery.magnific-popup.min.js') }}"></script>

    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('landing/js/ajax-contact.js') }}"></script>

    <!--====== Isotope js ======-->
    <script src="{{ asset('landing/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing/js/isotope.pkgd.min.js') }}"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="{{ asset('landing/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('landing/js/scrolling-nav.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('landing/js/main.js') }}"></script>
    <script src="{{ asset('landing/js/contentdata.js') }}"></script>

</body>

</html>