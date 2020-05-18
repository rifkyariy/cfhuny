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
                <h1 class=" text-center mt-120">Kategori Seni</h1>
            </div>
            <div class="team-image">
                <img class="mx-auto d-block" src="{{ asset('landing'.'/'.'images'.'/'.'icon'.'/'.'art.svg') }}"
                    alt="Kategori Pendidikan">
            </div>
            <div class="container mt-50">
                <div class="vcc">
                    <h3>A. Virtual Choir Competition</h3><br>
                    <p style="line-height: 200%" class="ml-30">Selain sektor ekonomi, sosial, dan pendidikan, berbagai
                        seni pertunjukan juga terdampak adanya covid-19 ini. Adanya larangan untuk berkumpul dan membuat
                        kerumunan dalam jumlah yang banyak menyebabkan beberapa pertunjukan dan kompetisi seni harus
                        diundur atau bahkan dibatalkan. Oleh sebab itu, UNY berinovasi untuk membuat virtual competition
                        dalam bidang seni khususnya paduan suara dan vokal grup.</p><br>
                    <h4 class="ml-30">Ketentuan Khusus </h4><br>
                    <p style="line-height: 200%" class="ml-30">Video diunggah melalui Youtube dengan format judul video
                        “Virtual Choir Competition – Paduan
                        Suara/Vokal Grup - Kode PT - Nama Tim” (Kode PT bisa dilihat di laman <a
                            href="https://forlap.ristekdikti.go.id/">https://forlap.ristekdikti.go.id/</a>), kemudian
                        mengisi tautan/ link Youtube pada
                        system <a href="https://cartesion.uny.ac.id">cartesion.uny.ac.id</a> </p><br>
                    <h5 class="ml-30">a. Paduan Suara</h5>
                    <ol style="list-style-type: decimal;line-height: 200%" class="ml-55">
                        <li>Terdiri dari 20-45 orang</li>
                        <li>Peserta membawakan 1 program lagu folklore / lagu daerah, yang telah disesuaikan dalam
                            format paduan suara</li>
                        <li>Dinyanyikan tanpa iringan musik / acapella</li>
                        <li>Durasi video maksimal 10 menit (termasuk bumper dan credit title)</li>
                    </ol><br>
                    <h5 class="ml-30">b. Vokal Grup</h5>
                    <ol style="list-style-type: decimal;line-height: 200%" class="ml-55">
                        <li>Terdiri dari 6-14 orang</li>
                        <li>Peserta membawakan 1 program lagu pop & jazz</li>
                        <li>Dinyanyikan tanpa iringan musik / acapella</li>
                        <li>Durasi video maksimal 7 menit (termasuk bumper dan credit title)</li>
                    </ol>
                </div><br>
                <div class="podcast">
                    <h3>B. Podcast 'Siniar' Pembacaan Cerpen Dan Drama Audio</h3><br>
                    <p style="line-height: 200%" class="ml-30">Di tengah situasi pandemi Corona COVID-19, Universitas
                        Negeri Yogyakarta (UNY) memberikan ruang alternatif bagi keberlangsungan daya hidup sastra
                        kampus dengan cara menyelenggarakan Lomba Podcast ‘Siniar’ Pembacaan Cerpen Dan Drama Audio
                        tingkat mahasiswa seluruh Indonesia. Perlombaan ini diselenggarakan secara online (dalam
                        jaringan) dengan tetap mengedepankan Protokol Kesehatan Penanganan Corona COVID-19. Pada edisi
                        kali ini akan berfokus pada cerpen dan drama audio atau yang lebih dikenal dengan istilah drama
                        radio</p><br>
                    <h4 class="ml-30">Ketentuan Khusus</h4><br>
                    <p style="line-height: 200%" class="ml-30">Podcast diunggah melalui www.anchor.fm dan wajib
                        menyertakan tagar #uny dan #universitasnegeriyogyakarta pada akhir judul Podcast. Kemudian
                        mengisi tautan/ link podcast yang telah diunggah, pada
                        sistem <a href="https://cartesion.uny.ac.id">cartesion.uny.ac.id</a> </p>
                    <ol style="list-style-type: decimal; line-height: 200%" class="ml-55">
                        <li>Perlombaan diikuti secara berkelompok (maksimal 10 orang tiap kelompok)</li>
                        <li>Usia Peserta tidak dibatasi</li>
                        <li>Menandatangani surat pernyataan bermeterai bahwa karya yang dibuat asli (bukan plagiat)
                            dan belum pernah memperoleh penghargaan/juara pada lomba serupa/sejenis. (tanda tangan ketua
                            tim), format surat dapat diunduh di laman <a
                                href="https://cartesion.uny.ac.id">cartesion.uny.ac.id</a></li>
                        <li>Audio Podcast pembacaan cerpen dan Podcast drama audio yang diikutsertakan dalam perlombaan
                            ini tidak sedang diikutsertakan dalam perlombaan serupa</li>
                        <li>Audio Podcast pembacaan cerpen dan Podcast drama audio berbahasa Indonesia</li>
                        <li>Peserta diperkenan mengikutsertakan karya lebih dari satu, dengan batas maksimal dua buah
                            karya per kelompok</li>
                        <li>Peserta wajib menyertakan tautan/link Podcast yang diikutsertakan</li>
                        <li>Peserta wajib mengisi Formulir Pendaftaran pada tautan/ link </li>
                    </ol><br>
                    <div class="vmc">
                        <h3>C. Virtual Music Competition</h3><br>
                        <p style="line-height: 200%" class="ml-30">Selain sektor ekonomi, sosial, dan pendidikan,
                            berbagai
                            seni pertunjukan juga terdampak adanya covid-19 ini. Adanya larangan untuk berkumpul dan
                            membuat
                            kerumunan dalam jumlah yang banyak menyebabkan beberapa pertunjukan dan kompetisi seni harus
                            diundur atau bahkan dibatalkan. Oleh sebab itu, UNY berinovasi untuk membuat virtual
                            competition
                            dalam bidang seni yaitu musik dapat berupa band ataupun akustik</p><br>
                        <h4 class="ml-30">Ketentuan Khusus </h4><br>
                        <p style="line-height: 200%" class="ml-30">Video diunggah melalui Youtube dengan format judul
                            video “Virtual Music Competition – Band/Akustik - Kode PT - Nama Tim” (Kode PT bisa dilihat
                            di laman <a href="https://forlap.ristekdikti.go.id/">https://forlap.ristekdikti.go.id/</a>),
                            kemudian
                            mengisi tautan/ link Youtube pada
                            system <a href="https://cartesion.uny.ac.id">cartesion.uny.ac.id</a>
                            Kompetisi musik terbagi dalam dua kategori (Band dan Akustik ). Dimohon Peserta
                            memperhatikan ketentuan dalam tiap kategori.</p><br>
                        <h5 class="ml-30">a. Band</h5>
                        <ol style="list-style-type: decimal;line-height: 200%" class="ml-55">
                            <li>Dalam satu grup terdiri dari maksimal tujuh orang</li>
                            <li>Peserta membawakan 1 program lagu dalam negeri bebas</li>
                            <li>Durasi video maksimal 10 menit</li>
                            <li>Durasi video maksimal 10 menit (termasuk bumper dan credit title)</li>
                        </ol><br>
                        <h5 class="ml-30">b. Akustik</h5>
                        <ol style="list-style-type: decimal;line-height: 200%" class="ml-55">
                            <li>Dalam satu grup terdiri dari maksimal tujuh orang</li>
                            <li>Peserta membawakan satu lagu dalam negeri bebas</li>
                            <li>Alat musik yang digunakan adalah alat musik akustik dan diperkenankan menambahkan alat music tradisional</li>
                            <li>Durasi video maksimal sepuluh menit</li>
                        </ol>
                    </div><br>

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