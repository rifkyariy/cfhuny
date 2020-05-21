@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
            aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
            <div class="navbar-collapse-header">

                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="dashboard.html">
                            <img src="{{ asset('/img/brand/logo-alt-white.svg') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="d-lg-none" />
        </div>
    </div>
</nav>

<!-- Main content -->
<div class="main-content">
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");

        </script>
    @endif
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-7">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <a class="navbar-brand" href="{{ route('landingpage') }}">
                            <img src="{{ asset('/img/brand/logo-alt-white.png') }}"
                                width="100%">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="card-header text-center">
                                <h3>
                                    {{ __('Verify Your Email Address') }}
                                </h3>
                            </div>
            
                            <div class="card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif
            
                                {{ __('Email verifikasi telah dikirim ke email anda , tolong periksa email anda.') }}
                                <br>
                                <br>
                                {{ __('Apabila anda tidak menerima email verifikasi, klik tombol dibawah untuk mengirim ulang.') }},
                                <br>
                                <div class="text-center">
                                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="mt-5 btn btn-primary ">{{ __('Kirim Ulang') }}</button>.
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection

                @section('localjs')
                <script>
                    $(document).ready(function () {
                        $('body').addClass('dark-bg');
                    })

                </script>
                @endsection
