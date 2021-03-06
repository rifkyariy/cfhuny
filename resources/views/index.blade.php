<!doctype html>
<html class="no-js" lang="en">

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

    <section class="navbar-area">
        <div class="container">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">


                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo"
                            aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav  f-left">
                                <li class="nav-item active">
                                    <a class="page-scroll" href="#home">
                                        <img class="cartesionlogo" src="{{ asset('landing/images/logo-alt-white.png') }}"/>
                                    </a>
                                </li>
                                <li class="nav-item"><a class="page-scroll" href="#tentangUnyCartesion">Tentang</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#kategorilomba">Kategori Lomba</a>
                                </li>
                                <li class="nav-item"><a class="page-scroll" href="#berita">Berita</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#faq">FAQ</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#kodePT">Kode PT</a></li>
                                
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

    <!--====== SLIDER PART START ======-->

    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <li data-target="#carouselThree" data-slide-to="1"></li>
                <li data-target="#carouselThree" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">

            </div>

            <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
    </section>

    <!--====== SLIDER PART ENDS ======-->

    <!--====== Tentang Gemastik PART START ======-->

    <section id="tentangUnyCartesion" class="testimonial-area">
        <div class="container">
            <div class="row justify-content-between">
                
                <div class="col-lg-6">
                    <div class="testimonial-right-content mt-50">
                        <div class="quota flip-180">
                            <i class="lni lni-book"></i>
                        </div>
                        <div class="testimonial-content-wrapper testimonial-active">
                            <div class="single-testimonial">

                                <img class="gemastiklogo" src="{{ asset('landing/images/logo-unycartesion.png') }}"
                                    alt="" srcset="">
                            </div> <!-- single testimonial -->

                        </div> <!-- testimonial content wrapper -->
                    </div> <!-- testimonial right content -->
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="testimonial-left-content tentang-UnyCartesion-content mt-45">

                    </div> <!-- testimonial left content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== TESTIMONIAL PART ENDS ======-->

    <!--====== Bidang Lomba PART START ======-->

    <section id="kategorilomba" class="features-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Kategori Lomba</h3>
                        <p class="text">
                            Jadi di UNY Cartesion nanti bakal ada bidang lomba apa aja sih ?
                        </p>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center kategori-lomba-content">

            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FEATRES TWO PART ENDS ======-->
    <!--====== TEAM START ======-->

    <section id="berita" class="team-area pt-120 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">Berita dan Pengumuman</h3>
                        <p class="text">Lagi nyari info berita atau pengumuman ? kuy simak</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <br><br>
            <div class="row">
                @foreach($berita as $b)
                <div class="col-lg-4 col-sm-6">
                    <div class="team-style-eleven text-center mt-30 wow fadeIn" data-wow-duration="1s"
                        data-wow-delay="0s">
                        <div class="team-image">
                            <img src="{{ asset('img'.'/'.'theme'.'/'.$b->gambar) }}" alt="Berita">
                        </div>
                        <div class="team-content">
                            <div class="team-social">
                                <ul class="social">
                                    <li><a href="/detailBerita/{{$b->id}}">Selengkapnya</a></li>
                                </ul>
                            </div>
                            <h4 class="team-name"><a href="/detailBerita/{{$b->id}}">{{$b->judul}}</a></h4>
                            <span class="sub-title ellipsis">{{$b->keterangan}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- row -->
        </div> <!-- container -->
    </section>

    
    <!--====== FAQ START ======-->

    <section id="faq" class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="faq-content mt-45">
                        <div class="about-title">

                        </div> <!-- faq title -->
                        <div class="about-accordion">
                            <div class="accordion" id="accordionExample">

                            </div>
                        </div> <!-- faq accordion -->
                    </div> <!-- faq content -->
                </div>
                <div class="col-lg-6">
                    <div class="about-image ml-60 mt-200">
                        <img src="{{asset('landing/images/img-faq.svg')}}" alt="Faq">
                    </div> <!-- faq image -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FAQ PART ENDS ======-->

    <!--====== KODE PT START ======-->
    <section id="kodePT" class="pt-120 pb-80">
        <div class="s130">
            <form>
            <div class="section-title text-center pb-30">
                <h3 class="title text-white">Cari Kode Perguruan Tinggi</h3>
            </div>
                <div class="inner-form">
                    <div class="input-field first-wrap">
                        <div class="svg-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                </path>
                            </svg>
                        </div>
                        <select class="form-control" id="input-university">
                        </select>
                        {{-- <input id="search" type="text" placeholder="Nama Perguruan Tinggi" /> --}}
                    </div>
                    <div class="input-field second-wrap">
                        <button class="btn-search" type="button">SEARCH</button>
                    </div>
                </div>
                <span class="info">
                    <div class="result">
                        
                    </div>
                </span>

            </form>
        </div>
        
    </section>
    <!--====== KODE PT  ENDS ======-->


    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">Masih Ada Yang Mau Ditanyaiin ?</h3>
                        <p class="text">Daripada bingung mau tanya kemana ,bisa langsung hubungi kontak di bawah ini
                        </p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <div class="contact-info pt-30">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 ">
                            <div class="contact-info-icon text-center">
                                <i class="lni lni-instagram"></i>
                            </div>
                            <div class="contact-info-content media-body mt-2">
                                <p class="text"><a href="https://www.instagram.com/kemahasiswaan.uny/">@kemahasiswaan.uny</a></p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body mt-2">
                                <p class="text">0851-5621-3423 (Admin Penalaran UNY)</p>
                                <p class="text">0812-1530-0118 (Kemahasiswaan UNY)</p>
                                <p class="text">0822-9209-5082 (Wuwu)</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-4 mt-30">
                            <div class="contact-info-icon ">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body  mt-2">
                                <p class="text"><a href="mailto:kemahasiswaan@uny.ac.id">kemahasiswaan@uny.ac.id</a></p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row -->
            </div> <!-- contact info -->
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="contact-wrapper form-style-two pt-115">
                        <h4 class="contact-title pb-10"><i class="lni lni-envelope"></i> Leave <span>A Message.</span>
                        </h4>

                        <form id="contact-form" action="contact.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label>Name</label>
                                        <div class="input-items default">
                                            <input name="name" type="text" placeholder="Name">
                                            <i class="lni lni-user"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label>Email</label>
                                        <div class="input-items default">
                                            <input type="email" name="email" placeholder="Email">
                                            <i class="lni lni-envelope"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-input mt-25">
                                        <label>Massage</label>
                                        <div class="input-items default">
                                            <textarea name="massage" placeholder="Massage"></textarea>
                                            <i class="lni lni-pencil-alt"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="form-input light-rounded-buttons mt-30">
                                        <button class="main-btn light-rounded-two">Send Message</button>
                                    </div> <!-- form input -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact wrapper form -->
                </div>
            </div> <!-- row --> --}}
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->

    <!--====== FOOTER PART START ======-->

    <section class="footer-area bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-logo text-center">
                        <a class="mt-50" href="https://cartesion.uny.ac.id">
                            <img src="{{ asset('landing/images/logo-unycartesion.png') }}" width="80%" alt="">
                        </a>
                    </div> <!-- footer logo -->
                    <ul class="social text-center mt-40">
                        <li><a href="https://cartesion.uny.ac.id"><i><img src="/landing/images/globe.svg" width="25px"
                                        height="25px" alt="website"></i></a></li>
                        <li><a href="https://www.instagram.com/uny_official/?hl=id"><i><img
                                        src="/landing/images/instagram.svg" width="25px" height="25px"
                                        alt="website"></i></a></li>
                    </ul> <!-- social -->
                    <div class="footer-support text-center">
                        <span class="mail">kemahasiswaan@uny.ac.id</span>
                        <span class="mail">                
                            &copy; 2020 <a href="https://infiniteuny.id" class="font-weight-bold ml-1" target="_blank">Infinite UNY</a>
                        </span>
                    </div>
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
    
    <!--====== Extension js =======-->
    <script src="{{asset('js/extension/select2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <!--====== Main js ======-->
    <script src="{{ asset('landing/js/main.js') }}"></script>
    <script src="{{ asset('landing/js/contentdata.js') }}"></script>



</body>

</html>