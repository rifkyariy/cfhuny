@extends('layouts.app')

@section('content')
    
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
                <i class="ni ni-tv-2 text"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('teams.index') }}">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Undangan Tim</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">
                <i class="ni ni-single-copy-04 text-primary"></i>
                <span class="nav-link-text">File Referensi</span>
              </a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('teams.index')}}">
                <i class="ni ni-sound-wave text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('users.profile') }}">
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
          <!-- Search form -->
          <!-- Navbar links -->
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
              <h6 class="h2 text-white d-inline-block mb-0">Profil</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
                  <i class="ni education_hat mr-2"></i>
                  @if ($pt!=null)
                    {{$pt->name}}
                  @else
                    Profil Belum Dilengkapi
                  @endif
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
                  <h3 class="mb-0">Lengkapi Profil </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('users.update', [Auth::user()->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nama Lengkap</label>
                        <input type="text" name="name" id="input-username" class="form-control {{ $errors->first('name') ? 'is-invalid' : ''}}" placeholder="Nama Lengkap" value="{{ Auth::user()->name }}" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Alamat Email</label>
                        <input type="email" name="email" id="input-email" class="form-control" placeholder="{{ Auth::user()->email}}" value="{{ Auth::user()->email}}" readonly="readonly">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-university">Universitas</label>
                        <input id="input-university-id" name="university_id" type="hidden" value="{{ Auth::user()->university_id }}">
                        <select class="form-control" id="input-university">
                          @if ($pt!=null)
                            <option value="{{$pt->id}}">{{$pt->name}}</option>
                          @endif
                        </select>
                        <div class="invalid-feedback">
                          {{ $errors->first('university_id') }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">NIM</label>
                        <input id="input-address" name="nim" class="form-control {{ $errors->first('nim') ? 'is-invalid' : ''}}" placeholder="Nomor Induk Mahasiswa" type="text" value="{{ Auth::user()->nim }}" required>
                        <div class="invalid-feedback">
                          {{ $errors->first('nim') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Program Studi</label>
                        <input id="input-address" name="prodi" class="form-control {{ $errors->first('prodi') ? 'is-invalid' : ''}}" placeholder="Program Studi" type="text" value="{{ Auth::user()->prodi }}" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('prodi') }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">No Hp</label>
                        <input type="text" name="phone" id="input-username" class="form-control {{ $errors->first('phone') ? 'is-invalid' : ''}}" value="{{ Auth::user()->phone }}" placeholder="No Hp" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group ">
                        <label class="form-control-label" for="input-email">Foto Kartu Tanda Mahasiswa</label>
                        <div class="ktmform">
                          @if (Auth::user()->ktm==null)
                            <input type="file" name="ktm" class="form-control {{ $errors->first('ktm') ? 'is-invalid' : ''}}" required>  
                            <br>
                            <h5>File harus berformat jpg atau png</h5>
                            <h5>Ukuran maksimal 4MB</h5>
                          @else
                            <a class="btn btn-form btn-warning" id="downloadKTM" onclick="downloadKTM()"><i></i>  Download KTM</a>
                            <a class="btn btn-form btn-success" id="reuploadKTM" onclick="reuploadKTM()">Upload Ulang</a>
                          @endif
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('ktm') }}
                        </div>
                      </div>
                    </div>
                  </div>             
                </div>
                <hr class="my-4" />
                <div class="pl-lg-4 float-right">
                    <button type="submit" id="updateProfile" class="btn btn-primary"><i></i>  Update Profil</button>
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
  
 
@endsection

@section('localjs')
<!-- Local JS -->
<script>
  $(document).ready(function() {
  
    // initiate select2
    $('#input-university').select2({
      ajax: {
        url: '{{url("/api/sel2/perguruantinggi")}}',
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
            results: $.map(data, function(obj) {
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
  $('#input-university').on('change',() => {
    let id = $('#input-university :selected').val();
    $('#input-university-id').val(id) ;
  })

  // download KTM 
  let downloadKTM = () => {
    $('#downloadKTM i').addClass('fa fa-spinner loading');
    window.location = `{{url("/api/file/ktm/")."?filename=".Auth::user()->ktm}}`;
    
    setTimeout(function() {
      $('#downloadKTM i').removeClass('fa fa-spinner loading');
    }, 5800); 
  };

  // reupload KTM
  let reuploadKTM = () => {
    $('.ktmform').html(`
      <div class="row">
        <div class="col-lg-9">
          <input type="file" name="ktm" class="form-control {{ $errors->first('ktm') ? 'is-invalid' : ''}}" required>  
          <br>
          <h5>File harus berformat jpg atau png</h5>
          <h5>Ukuran maksimal 4MB</h5>
        </div>
        <div class="col-lg-3">
          <a class="btn btn-form btn-danger" id="batalReupload" onclick="batalReupload()">Batal</a>
        </div>
      <div>
    `);
  };

  let batalReupload = () => {
    $('.ktmform').html(`
      <a class="btn btn-form btn-warning" id="downloadKTM" onclick="downloadKTM()"><i></i>  Download KTM</a>
      <a class="btn btn-form btn-success" id="reuploadKTM" onclick="reuploadKTM()">Upload Ulang</a>
    `);
  };

  $('#updateProfile').on('click',()=>{
    $('#updateProfile i').addClass('fa fa-spinner loading');
  })



  
</script>    
@endsection