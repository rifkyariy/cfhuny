{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email"
                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>


            </div>
        </div>

        <div class="form-group row">
            <label for="password"
                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if(Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection--}}


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
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-2 mb-3"><small>Silahkan Masuk dengan </small></div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Email" type="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" placeholder="Password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember me') }}
                            </label>
                            <div class="text-center">
                                <a href="{{ url('/register') }}"
                                    class="btn btn-warning my-4">Registrasi</a>
                                <button type="submit" class="btn btn-primary my-4">Masuk</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-lg-5 pb-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Atau dengan akun berikut</small>
                        </div>
                        <div class="btn-wrapper text-center">
                            <a href="{{ url('/auth/google') }}" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img
                                        src="{{ asset('img/icons/common/google.svg') }}"></span>
                                <span class="btn-inner--text">Google</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div class="row mt-3">
                    <div class="col-6">
                      <a href="{{route('password.request')}}" class="text-light"><small>Lupa Password?</small></a>
                    </div>
                    <div class="col-6 text-right">
                      <a href="{{url('/register')}}" class="text-light"><small>Buat akun</small></a>
                    </div>
                </div> --}}
                <!-- 
                    </div>
                  </div>
                </div>
              </div>-->
              <!-- Footer -->
                <footer class="py-5" id="footer-main">
                    <div class="container">
                        <div class="row align-items-center   justify-content-xl-between">
                            <div class="col-xl-12 ">
                                <div class="copyright text-center text-muted">
                                    &copy; 2020 <a href="https://infiniteuny.id" class="font-weight-bold ml-1"
                                        target="_blank">Infinite UNY</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                @endsection

                @section('localjs')
                <script>
                    $(document).ready(function () {
                        $('body').addClass('dark-bg');
                    })

                </script>
                @endsection
