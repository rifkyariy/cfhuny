<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Website Internal Gemastik - Edit Tim</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('landing/images/favicon.svg') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('css/argon.css?v=1.2.0')}}" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <br> <br>
      <div class="navbar-brand">
        <div class="sidenav-header  align-items-center">
            {{-- <img src="{{asset('img/brand/logo-infinite.png')}}" class="navbar-brand-img" alt="Logo Infinite"> --}}
            Distancing Fest.
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
          @if(Auth::user()->role != "Mahasiswa")
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.index')}}">
                <i class="ni ni-sound-wave text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            </li>
            @if(Auth::user()->role != "Admin")
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('teams.index') }}">
                  <i class="ni ni-chat-round text-primary"></i>
                    <span class="nav-link-text">Undangan Tim</span>
                </a>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('teams.index') }}">
                  <i class="ni ni-chat-round text-primary"></i>
                    <span class="nav-link-text">Tim</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                  <i class="ni ni-badge text-primary"></i>
                    <span class="nav-link-text">Pengguna</span>
                </a>
              </li>  
            @endif
            <li class="nav-item">
              <a class="nav-link" href="">
                <i class="ni ni-single-copy-04 text-primary"></i>
                <span class="nav-link-text">File Referensi</span>
              </a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link active" href="{{route('teams.index')}}">
                <i class="ni ni-sound-wave text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.profile') }}">
                <i class="ni ni-single-02 text-primary"></i>
                <span class="nav-link-text">Profil</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">
                <i class="ni ni-single-copy-04 text-primary"></i>
                <span class="nav-link-text">File Referensi</span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{ Auth::user()->avatar }}">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>                
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Edit Tim</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                  @if(Auth::user()->role != "Mahasiswa")
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                  @else
                    <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Dashboard</a></li>
                  @endif
                  <li class="breadcrumb-item"><a href="{{ route('teams.show', [$team->id]) }}">Tim</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Tim</li>
                </ol>
              </nav>
            </div>
          </div>          
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6"> 
    @if(session('message'))
        <div class="alert alert-primary">
            {{ session('message') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
     <div class="row">
     <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
            <img src="{{ asset('img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle">
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
  
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  {{ Auth::user()->name }}
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i> {{ Auth::user()->nim ? Auth::user()->nim : "Belum ada NIM" }}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>{{ Auth::user()->prodi ? Auth::user()->prodi : "Belum ada Program Studi" }}
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>Universitas Negeri Yogyakarta
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Undang Anggota</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('teams.update', [$team->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name=_method value="PUT">
                <h6 class="heading-small text-muted mb-4">Informasi Tim</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nama Tim</label>
                        <input type="text" name="name" value="{{ $team->name }}" id="input-username" class="form-control {{ $errors->first('name') ? 'is-invalid' : ''}}" placeholder="Nama Tim">
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Cabang Lomba</label> <br>
                        <select class="form-control {{ $errors->first('cabang_lomba') ? 'is-invalid' : ''}}" name="cabang_lomba">
                            <option value="">- Pilih -</option>
                            @if($team->cabang_lomba == "Penambangan Data")
                                <option value="Penambangan Data" selected>Penambangan Data</option>
                            @else
                                <option value="Penambangan Data">Penambangan Data</option>
                            @endif
                            @if($team->cabang_lomba == "Pengembangan Bisnis TIK")
                                <option value="Pengembangan Bisnis TIK" selected>Pengembangan Bisnis TIK</option>
                            @else
                                <option value="Pengembangan Bisnis TIK">Pengembangan Bisnis TIK</option>
                            @endif
                            @if($team->cabang_lomba == "Animasi")
                                <option value="Animasi" selected>Animasi</option>
                            @else
                                <option value="Animasi">Animasi</option>
                            @endif
                            @if($team->cabang_lomba == "Kota Cerdas")
                                <option value="Kota Cerdas" selected>Kota Cerdas</option>
                            @else
                                <option value="Kota Cerdas">Kota Cerdas</option>
                            @endif
                            @if($team->cabang_lomba == "Piranti Cerdas, Sistem Benam dan IOT")
                                <option value="Piranti Cerdas, Sistem Benam dan IOT" selected>Piranti Cerdas, Sistem Benam dan IOT</option>
                            @else
                                <option value="Piranti Cerdas, Sistem Benam dan IOT">Piranti Cerdas, Sistem Benam dan IOT</option>
                            @endif
                            @if($team->cabang_lomba == "Pengembangan Aplikasi Permainan")
                                <option value="Pengembangan Aplikasi Permainan" selected>Pengembangan Aplikasi Permainan</option>
                            @else
                                <option value="Pengembangan Aplikasi Permainan">Pengembangan Aplikasi Permainan</option>
                            @endif
                            @if($team->cabang_lomba == "Desain Pengalaman Pengguna")
                                <option value="Desain Pengalaman Pengguna" selected>Desain Pengalaman Pengguna</option>
                            @else
                                <option value="Desain Pengalaman Pengguna">Desain Pengalaman Pengguna</option>
                            @endif
                            @if($team->cabang_lomba == "Pengembangan Perangkat Lunak")
                                <option value="Pengembangan Perangkat Lunak" selected>Pengembangan Perangkat Lunak</option>
                            @else
                                <option value="Pengembangan Perangkat Lunak">Pengembangan Perangkat Lunak</option>
                            @endif        
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('cabang_lomba') }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Undang Anggota</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label {{ $errors->first('anggota1') ? 'is-invalid' : ''}}" for="input-address">Anggota 1</label> <br>
                        <select class="form-control" name="anggota1">
                            <option value="">- Pilih Anggota -</option>
                            @foreach($users as $user)
                                @if($user->role == "Mahasiswa")
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('anggota1') }}
                        </div>
                        <br>
                       <h5>* Undangan anggota sebelumnya tidak dibatalkan</h5>
                       <h5>* Kosongkan jika tidak ingin mengundang anggota baru</h5>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Anggota 2</label> <br>
                        <select  class="form-control {{ $errors->first('anggota2') ? 'is-invalid' : ''}}" name="anggota2">
                            <option value="">- Pilih Anggota -</option>
                            @foreach($users as $user)
                                @if($user->role == "Mahasiswa")
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('anggota2') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label {{ $errors->first('dosbing') ? 'is-invalid' : ''}}" for="input-username">Dosen Pembimbing</label> <br>
                        <select  class="form-control" name="dosbing">
                            <option value="">- Pilih Anggota -</option>
                            @foreach($users as $user)
                                @if($user->role == "Dosen")
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('dosbing') }}
                        </div>
                      </div>
                    </div>
                  </div>           
                </div>
                <div class="pl-lg-4">
                    <button type="submit" class="btn btn-primary">Edit Tim</button>
                    <a href="{{ route('teams.show', [$team->id]) }}" class="btn btn-danger">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="https://infiniteuny.id" class="font-weight-bold ml-1" target="_blank">Infinite UNY</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  </script>
  <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{asset('vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('js/argon.js?v=1.2.0')}}"></script>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if(session('error'))
        <script>
          alert("{{session('error')}}");
        </script>
    @endif
    <form action="{{ route('teams.update', [$team->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        Nama tim : <input type="text" name="name" value="{{ $team->name }}"> <br>
        Anggota 1 : 
        <select name="anggota1" id="">
            <option value="" selected="selected">- Pilih -</option>
            @foreach($users as $user)
                @if($user->role == "Mahasiswa")
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif
            @endforeach
        </select> <br>
        Anggota 2 : 
        <select name="anggota2" id="">
            <option value="" selected="selected">- Pilih -</option>
            @foreach($users as $user)
                @if($user->role == "Mahasiswa")
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif            
            @endforeach
        </select> <br>
        Dosbing : 
        <select name="dosbing" id="">
            <option value="" selected="selected">- Pilih -</option>
            @foreach($users as $user)
                @if($user->role == "Dosen")
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif            
            @endforeach
        </select> <br> <br>
        <button type="submit">Submit</button>
    </form>
</body> -->
</html>