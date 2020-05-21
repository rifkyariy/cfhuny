{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-control-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-control-label">{{ __('E-Mail Address') }}</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-control-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm"
                class="form-control-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>

        <div class="form-group">
            <label class="form-control-label" for="input-university">Universitas</label>
            <input id="input-university-id" name="university_id" type="hidden" value="">
            <select class="form-control" id="input-university">
                <option value=""></option>
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('university_id') }}
            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label" for="input-address">NIM</label>
            <input id="input-address" name="nim"
                class="form-control {{ $errors->first('nim') ? 'is-invalid' : '' }}"
                placeholder="Nomor Induk Mahasiswa" type="text" value="" required>
            <div class="invalid-feedback">
                {{ $errors->first('nim') }}
            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label" for="input-address">Program Studi</label>
            <input id="input-address" name="prodi"
                class="form-control {{ $errors->first('prodi') ? 'is-invalid' : '' }}"
                placeholder="Program Studi" type="text" value="" required>
            <div class="invalid-feedback">
                {{ $errors->first('prodi') }}
            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label" for="input-username">No Hp</label>
            <input type="text" name="phone" id="input-username"
                class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                value="" placeholder="No Hp" required>
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
        </div>



        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-12">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
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
    <div class="header bg-gradient-primary py-6 py-lg-6 pt-lg-6">
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
            <div class="col-lg-8 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-1 mb-3">
                            <h3>
                                Registrasi
                            </h3>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name"
                                    class="form-control-label">{{ __('Nama Ketua') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name"
                                    placeholder="Nama Ketua" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email"
                                    class="form-control-label">{{ __('Alamat Email') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required
                                    autocomplete="email" placeholder="Alamat Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password"
                                    class="form-control-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="*******">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"
                                    class="form-control-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="*******">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="input-university">Universitas</label>
                                <input id="input-university-id" name="university_id" type="hidden" value="">
                                <select class="form-control" id="input-university">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('university_id') }}
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ url('/login') }}"
                                    class="btn btn-secondary my-1">Kembali</a>
                                <button type="submit" class="btn btn-primary my-">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-lg-5 pb-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Atau registrasi dengan akun berikut</small>
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
                      <a href="{{ route('password.request') }}" class="text-light"><small>Lupa
                    Password?</small></a>
            </div>
            <div class="col-6 text-right">
                <a href="{{ url('/register') }}" class="text-light"><small>Buat akun</small></a>
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
        <!-- Local JS -->
        <script>
            $(document).ready(function () {
                $('body').addClass('dark-bg');

                // initiate select2
                $('#input-university').select2({
                    ajax: {
                        url: '{{ url("/api/sel2/perguruantinggi") }}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            var query = {
                                search: params.term
                            }

                            // Query parameters will be ?search=[term]&page=[page]
                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (obj) {
                                    return {
                                        id: obj.id,
                                        text: obj.text
                                    };
                                })
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Pilih Perguruan Tinggi'
                });

            });

            // select2 onchange trigger
            $('#input-university').on('change', () => {
                let id = $('#input-university :selected').val();
                $('#input-university-id').val(id);
            })

        </script>
        @endsection
