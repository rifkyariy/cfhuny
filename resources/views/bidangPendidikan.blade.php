<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>UNY Distancing Festival</title>

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
                    <nav class="navbar navbar-expand-lg">


                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo"
                            aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav f-right">
                                <li class="nav-item active"><a class="page-scroll" href="/">Distancing Fest.</a>
                                </li>
                                <li class="nav-item"><a class="page-scroll" href="/#tentangUnyCartesion">Tentang</a>
                                </li>
                                <li class="nav-item"><a class="page-scroll" href="/#kategorilomba">Kategori Lomba</a>
                                </li>
                                <li class="nav-item"><a class="page-scroll" href="/#berita">Berita</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/#kodePT">Kode PT</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/#faq">FAQ</a></li>
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
                                <li><a class="solid" href="{{ url('/auth/google') }}">Masuk</a></li>
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
        <div class="container">
            <div>
                <h1 class=" text-center mt-120">Kategori Pendidikan</h1>
            </div>
            <div class="team-image">
                <img class="mx-auto d-block" src="{{ asset('landing'.'/'.'images'.'/'.'icon'.'/'.'edu.svg') }}"
                    alt="Kategori Pendidikan">
            </div>
            <div class="container mt-50">
                <div class="edu-multimedia">
                    <h3>A. Lomba Inovasi Multimedia Pembelajaran</h3><br>
                    <p style="line-height: 200%" class="ml-30">Lomba Inovasi Multimedia Pembelajaran merupakan bagian dari UNY Competition From
                        Home untuk mewadahi ide kreatif mahasiswa dalam bentuk inovasi multimedia pembelajaran pada masa
                        pandemi Covid-19. Lomba ini bertujuan untuk menyalurkan ide dan kreatifitas mahasiswa dalam
                        mengembangkan inovasi multimedia pembelajaran untuk meningkatkan kualitas pendidikan, mendorong
                        belajar mandiri, meningkatkan partisipasi dalam pembelajaran, ber-impact pada karakter peserta
                        didik sesuai kebutuhan di era industri 4.0 serta mendukung pendidikan jarak jauh pada masa
                        pandemi Covid-19. Kegiatan ini diharapkan dapat memotivasi mahasiswa untuk memberikan inovasi
                        multimedia pembelajaran demi kemajuan dan kemandirian bangsa di bidang pendidikan.</p>
                    <p class="ml-30">Jenis</p>
                    <p class="ml-40">a. Video</p>
                    <p class="ml-40">b. Software</p><br>
                    <h4 class="ml-30">Ketentuan Khusus Lomba Inovasi Multimedia Pembelajaran</h4><br>
                    <ol style="list-style-type: decimal;line-height: 200%" class="ml-45">
                        <li>Lomba bersifat kelompok yang terdiri dari 3 orang</li>
                        <li>Setiap peserta diperbolehkan mengikutsertakan maksimal 1 (satu) karya</li>
                        <li>Proposal diunggah melalui sistem cartesion.uny.ac.id dalam bentuk PDF maksimal 8 MB dengan
                            format nama file “Lomba Inovasi Online Pendidikan 2020 - Multimedia - Kode PT - Nama Tim –
                            Proposal.pdf” (Kode PT bisa dilihat di laman <a href="/#kodePT">Kode PT</a>)</li>
                        <li>Menandatangani surat pernyataan bermeterai bahwa karya yang dibuat asli (bukan plagiat) dan
                            belum pernah memperoleh penghargaan/juara pada lomba serupa/sejenis. (tanda tangan ketua
                            tim)</li>
                    </ol>
                </div><br>
                <div class="edu-pembelajaran">
                    <h3>B. Lomba Inovasi Pembelajaran</h3><br>
                    <p style="line-height: 200%" class="ml-30">Inovasi Pembelajaran adalah suatu gagasan tentang pendekatan, strategi, metode,
                        teknik, taktik, model, maupun perangkat pembelajaran yang baru dan/atau memiliki nilai kebaruan
                        (novelty), serta mampu membantu meningkatkan kualitas pembelajaran di tengah masa pandemi. Lomba
                        Inovasi Pembelajaran merupakan lomba yang diikuti oleh mahasiswa perguruan tinggi di Indonesia
                        dalam rangka berkompetisi pada tingkat nasional dalam menyusun karya inovatif dalam
                        pembelajaran. Karya tersebut diharapkan mampu memberikan kontribusi untuk memecahkan masalah
                        dalam proses pembelajaran serta meningkatkan kualitas pembelajaran tersebut, khususnya dalam
                        konteks masa pandemi Covid-19</p><br>
                    <h4 class="ml-30">Ketentuan Khusus Lomba Inovasi Pembelajaran</h4><br>
                    <ol style="list-style-type: decimal; line-height: 200%" class="ml-45">
                        <li>Lomba bersifat kelompok yang terdiri dari 3 orang</li>
                        <li>Setiap peserta diperbolehkan mengikutsertakan maksimal 1 (satu) karya</li>
                        <li>Menandatangani surat pernyataan bermeterai bahwa karya yang dibuat asli (bukan plagiat)
                            dan belum pernah memperoleh penghargaan/juara pada lomba serupa/sejenis. (tanda tangan ketua
                            tim), format surat dapat diunduh di laman <a href="https://cartesion.uny.ac.id">cartesion.uny.ac.id</a></li>
                        <li>Proposal diunggah melalui sistem <a href="https://cartesion.uny.ac.id">cartesion.uny.ac.id</a> dalam bentuk PDF maksimal 8 MB
                            dengan format nama file “Lomba Inovasi Online Pendidikan 2020 - Gagasan - Kode PT - Nama Tim
                            – Proposal.pdf” (Kode PT bisa dilihat di laman <a href="/#kodePT">Kode PT</a>)</li>
                        <li>Pengiriman proposal disertai dengan Pernyataan bahwa karya yang dilombakan belum pernah
                            diikutsertakan pada kompetisi lain (tanda tangan ketua tim)</li>
                    </ol>
                </div>
            </div>
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
                        <li><a href="https://cartesion.uny.ac.id"><i><img src="/landing/images/globe.svg" width="25px"
                                        height="25px" alt="website"></i></a></li>
                        <li><a href="https://www.instagram.com/uny_official/?hl=id"><i><img
                                        src="/landing/images/instagram.svg" width="25px" height="25px"
                                        alt="website"></i></a></li>
                    </ul> <!-- social -->
                    <div class="footer-support text-center">
                        <span class="number">0851-5621-3423 (Admin Penalaran UNY)</span>
                        <span class="number">0812-1530-0118 (Kemahasiswaan UNY)</span>
                        <span class="number">0822-9209-5082 (Wuwu)</span>
                        <span class="mail">cartesion@uny.ac.id</span>
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

    <!--====== Main js ======-->
    <script src="{{ asset('landing/js/main.js') }}"></script>
    <script src="{{ asset('landing/js/contentdata.js') }}"></script>

</body>

</html>