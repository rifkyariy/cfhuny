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
                                <li class="nav-item"><a class="page-scroll" href="/#kodePT">Kode PT</a>
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
                <h1 class=" text-center mt-120">Kategori Kewirausahaan</h1>
            </div>
            <div class="team-image">
                <img class="mx-auto d-block" src="{{ asset('landing'.'/'.'images'.'/'.'icon'.'/'.'bus.svg') }}"
                    alt="Kategori Pendidikan">
            </div>
            <div class="container mt-50">
                <div class="sbsp">
                    <h3>Lomba Small Business Sustainability Plan (SBSP)</h3><br>
                    <p style="line-height: 200%">Lomba SMALL BUSINESS SUSTAINABILITY PLAN (SBSP) TINGKAT NASIONAL
                        bertujuan untuk memberikan
                        kontribusi nyata dalam membantu permasalahan UMKM di Indonesia sebagai dampak pandemi Covid-19.
                        Mahasiswa atau kelompok mahasiswa dapat berperan dalam upaya mempertahankan, mengembangkan,
                        dan/atau membangkitkan kembali usaha mikro kecil menengah di Indonesia saat atau pasca pandemi
                        Covid-19. Rencana bisnis yang disusun oleh mahasiswa atau kelompok mahasiswa diharapkan mampu
                        menjadi solusi bagi UMKM untuk terus bertahan dan meningkatkan usaha.</p><br>
                    <h4>A. Ketentuan Khusus Lomba Small Business Sustainability Plan (SBSP)</h4><br>
                    <ol style="list-style-type: decimal; line-height: 200%" class="ml-30">
                        <li>Memilih UMKM yang sebelum pandemi Covid-19 masih berjalan dan saat ini berhenti atau UMKM
                            yang sampai saat ini masih berjalan namun mengalami berbagai kendala untuk bahan studi kasus
                            pembuatan strategi bisnis</li>
                        <li>Mahasiswa boleh memilih usaha yang dikelola sendiri dan/atau mitra UMKM, dibuktikan dengan
                            surat keterangan kesediaan mitra menjadi objek kajian Lomba Small Business Sustainability
                            Plan (SBSP). Format surat disesuaikan kebutuhan</li>
                        <li>Lomba bersifat individu/ kelompok. Kelompok maksimal terdiri dari 5 orang mahasiswa</li>
                        <li>Setiap perguruan tinggi diperbolehkan mengirimkan lebih dari 1 kelompok</li>
                        <li>Karya yang masuk menjadi hak Panitia.</li>
                        <li>Melakukan registrasi pada sistem cartesion.uny.ac.id </li>
                        <li>Membuat proposal strategi pengembangan UMKM dengan tema: “Strategi jitu UMKM menghadapi
                            pandemi Covid-19” dan mengunggah pada sistem <a
                                href="https://cartesion.uny.ac.id">cartesion.uny.ac.id</a> dengan format nama file “SBSP
                            2020 - Judul - Kode PT - Nama Tim – Proposal.pdf” (Kode PT bisa dilihat di laman <a href="/#kodePT">Kode PT</a> )</li>
                        <li>Seluruh proposal strategi bisnis yang diterima oleh panitia akan diseleksi berdasarkan
                            kriteria penilaian dan dipilih enam (6) tim terbaik untuk menjadi finalis, yang nantinya
                            akan mempresentasikan rancang bisnisnya di hadapan dewan juri melalui video conference. Tim
                            yang lolos seleksi tahap pertama diwajibkan mengirimkan file presentasi kepada panitia
                            sesuai waktu yang telah ditentukan dan tidak diperkenankan untuk diubah, dengan format nama
                            file “SBSP 2020 - Judul - Kode PT - Nama Tim – Presentasi.pdf” (Kode PT bisa dilihat di
                            laman <a href="/#kodePT">Kode PT</a> )
                        </li>
                        <li>Presentasi rancangan/strategi bisnis guna menyelesaikan permasalahan UMKM dilakukan maksimal
                            10 menit dan dilanjutkan tanya jawab 15 menit. </li>
                        <li>Dewan juri berhak membatalkan kemenangan peserta apabila terbukti ada indikasi kecurangan.
                            Keputusan dewan juri bersifat final dan tidak dapat diganggu gugat</li>
                        <li>Panitia akan menjaga kerahasian proposal business plan peserta</li>
                        <li>Seluruh rangkaian kegiatan lomba bersifat GRATIS, tidak dipungut biaya apapun</li>
                    </ol><br>
                    <h4>B. Sifat Ide dan Gagasan</h4>
                    <ol style="list-style-type: decimal; line-height: 200%" class="ml-30"><br>
                        <li>Tulisan bersifat logis, sistematis, dan tidak melakukan plagiasi ide/karya orang lain</li>
                        <li>Solusi rencana pengembangan bisnis diperuntukkan bagi usaha yang sudah berjalan</li>
                        <li>Ide rasional dan berbasis penyelesaian masalah dan solusi yang disampaikan dapat
                            direalisasikan oleh pelaku usaha</li>
                        <li>Straetgi bisnis yang diusulkan diharapkan dalam bentuk nyata bukan sekedar imajinasi</li>

                    </ol>

                </div><br>
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