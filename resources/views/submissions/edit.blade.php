@extends('layouts.app')

@section('content')
    <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <br> <br>
      <div class="navbar-brand">
        <div class="sidenav-header  align-items-center">
          <img src="{{asset('img/brand/logo-black.png')}}" class="navbar-brand-img" alt="Logo Infinite">
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
                    <img alt="Image placeholder" src="{{ Auth::user()->avatar?Auth::user()->avatar:asset('img/brand/avatar.png') }}" class="">
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
              <h6 class="h2 text-white d-inline-block mb-0">Submission</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                  @if(Auth::user()->role != "Mahasiswa")
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                  @else
                    <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Dashboard</a></li>
                  @endif
                  <li class="breadcrumb-item"><a href="{{ route('teams.show', [$teamId]) }}">Tim</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Submission</li>
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
          <div class="col-xl-3 order-xl-2">
            <div class="card card-profile">
            <img src="{{ asset('img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                    <img alt="Image placeholder" src="{{ Auth::user()->avatar?Auth::user()->avatar:asset('img/brand/avatar.png') }}" class="rounded-circle">
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
                  {{ $pt->name ?? 'Profil Belum Dilengkapi' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-9 order-xl-1">
          <div class="card">
            <!-- Card header --><div class="card">
            <div class="card-header">
              <span class="badge badge-pill badge-info">{{ $cabangLomba->name }}</span>
              <h2 class="mt-1"><b>{{ $team->name }}</b></h2>
              <h4 class="mb-2">{{ $pt->name }}</h4>
            </div>
            <div class="card-body">  

              {{-- <a href="" class="btn btn-square btn-warning btn-md">Upload Submission </a>
              <a href="" class="btn btn-square btn-success btn-md">Download</a>
              <a href="" class="btn btn-square btn-danger btn-md"> Hapus </a>
              <br> --}}

              <form method="POST" action="{{ route('submissions.update', [$subs->id,$team->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                
                <h6 class="heading-small text-muted mb-4">Upload Submission Tim</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group ">
                        <label class="form-control-label" for="judul_karya">Judul Karya</label>
                        <div class="judul">
                          <input 
                            id="judul_karya" 
                            type="text" 
                            name="judul_karya" 
                            class="form-control {{ $errors->first('link_subs') ? 'is-invalid' : ''}}" 
                            required
                            value="{{$subs->judul}}">  
                          
                        </div>
                        <div class="invalid-feedback">
                          {{ $errors->first('link_subs') }}
                        </div>
                      </div>
                    </div>
                    @if ($cabangLomba->proposal_submission == 1)
                      <div class="col-lg-6">
                        <div class="form-group ">
                          <label class="form-control-label" for="proposal">Proposal Karya</label>
                          <div class="proposalform">
                            @if ($subs->file != null)
                              <a class="btn btn-cl-white btn-form btn-warning" id="downloadProposal" onclick="downloadFile(this,'{{$subs->file}}')">  Download Proposal</a>
                              <a class="btn btn-cl-white btn-form btn-success" id="reuploadProposal" onclick="reuploadProposal('{{$subs->file}}')">Upload Ulang</a>
                            @else  
                              <input id="proposal" type="file" name="proposal" class="form-control {{ $errors->first('proposal') ? 'is-invalid' : ''}}" required>  
                              <br>
                              <h5>File harus berformat pdf</h5>
                              <h5>Ukuran maksimal 8MB</h5>  
                            @endif
                          </div>
                          <div class="invalid-feedback">
                            {{ $errors->first('proposal') }}
                          </div>
                        </div>
                      </div>
                    @elseif($cabangLomba->link_submission == 1)
                      <div class="col-lg-6">
                        <div class="form-group ">
                          <label class="form-control-label" for="link_subs">Tautan Video / Podcast Karya</label>
                          <div class="linkform">
                            <input 
                              id="link_subs" 
                              type="text" 
                              name="link_subs" 
                              class="form-control {{ $errors->first('link_subs') ? 'is-invalid' : ''}}" 
                              required
                              value="{{$subs->link}}">  
                            <br>
                            <h5>Merupakan tautan dari video Youtube, Anchor.fm maupun berbagai platform lainnya</h5>
                          </div>
                          <div class="invalid-feedback">
                            {{ $errors->first('link_subs') }}
                          </div>
                        </div>
                      </div>
                    @endif
                    <div class="col-lg-6">
                      <div class="form-group ">
                        <label class="form-control-label" for="lembar_orisinalitas">Lembar Orisinalitas </label>
                        <div class="originform">
                          @if ($subs->orisinalitas != null)
                            <a class="btn btn-cl-white btn-form btn-warning" id="downloadOrisinalitas" onclick="downloadFile(this,'{{$subs->orisinalitas}}')">  Download Lembar Orisinalitas</a>
                            <a class="btn btn-cl-white btn-form btn-success" id="reuploadOrisinalitas" onclick="reuploadOrisinalitas('{{$subs->orisinalitas}}')">Upload Ulang</a>
                          @else  
                            <input id="lembar_orisinalitas" type="file" name="lembar_orisinalitas" class="form-control {{ $errors->first('lembar_orisinalitas') ? 'is-invalid' : ''}}" required>  
                            <br>
                            <h5>File harus berformat doc ,docx ,pdf  </h5>
                            <h5>Ukuran maksimal 8MB</h5> 
                          @endif
                        </div>
                        <div class="invalid-feedback">
                          {{ $errors->first('lembar_orisinalitas') }}
                        </div>
                      </div>
                    </div>
                  </div>             
                </div>
                <div class="invalid-feedback">
                  {{ $errors->first('anggota${[anggota]}') }}
                </div>
                
                <label class="checkbox-label">
                  <input type="checkbox" id="acceptRequirement">
                  <span class="checkbox-custom rectangular"></span>
                </label>
                <label class="cblabel" for="acceptRequirement">Saya telah membaca segala persyaratan yang ada di dalam <a href="{{url('/panduan')}}">Panduan</a> dan menyetujuinya</label>
                
                <hr class="my-4" />
                <div class="pl-lg-4">
                    <button type="submit" id="submitKarya" class="btn btn-primary" disabled="true">  Perbarui Submission</button>
                </div>
              </form>
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
  </div>
@endsection

@section('localjs')
  <script>
    // download Proposal 
    let downloadFile = (clickedEl,file) => {
      addLoading(clickedEl);
      
      window.location = `/api/file/data?filename=${file}`;

    };

    // reupload Proposal
    reuploadProposal = (file) => {
      $(`.proposalform`).html(`
        <div class="row">
          <div class="col-lg-9">
            <input id="proposal" type="file" name="proposal" class="form-control {{ $errors->first('proposal') ? 'is-invalid' : ''}}" required>  
            <br>
            <h5>File harus berformat pdf</h5>
            <h5>Ukuran maksimal 8MB</h5>  
          </div>
          <div class="col-lg-3">
            <a class="btn btn-cl-white btn-form btn-danger" id="batalReupload" onclick="batalReuploadProposal('${file}')">Batal</a>
          </div>
        <div>
      `);
    };

    let batalReuploadProposal = (file) => {
      $(`.proposalform`).html(`
        <a class="btn btn-cl-white btn-form btn-warning" id="downloadProposal" onclick="downloadFile(this,'${file}')">  Download Proposal</a>
        <a class="btn btn-cl-white btn-form btn-success" id="reuploadProposal" onclick="reuploadProposal('${file}')">Upload Ulang</a>
      `);
    };

    // reupload Proposal
    reuploadOrisinalitas = (file) => {
      $(`.originform`).html(`
        <div class="row">
          <div class="col-lg-9">
            <input id="proposal" type="file" name="proposal" class="form-control {{ $errors->first('proposal') ? 'is-invalid' : ''}}" required>  
            <br>
            <h5>File harus berformat pdf</h5>
            <h5>Ukuran maksimal 8MB</h5>  
          </div>
          <div class="col-lg-3">
            <a class="btn btn-cl-white btn-form btn-danger" id="batalReupload" onclick="batalReuploadOrisinalitas('${file}')">Batal</a>
          </div>
        <div>
      `);
    };

    let batalReuploadOrisinalitas = (file) => {
      $(`.originform`).html(`
        <a class="btn btn-cl-white btn-form btn-warning" id="downloadOrisinalitas" onclick="downloadFile(this,'${file}')">  Download Lembar Orisinalitas</a>
        <a class="btn btn-cl-white btn-form btn-success" id="reuploadOrisinalitas" onclick="reuploadOrisinalitas('${file}')">Upload Ulang</a>
      `);
    };

    // add loading spinner
    let = addLoading = (selector) => {
      $(selector).prepend('<i class="fa fa-spinner loading"></i>');

      setTimeout(function() {
        $(`${selector} i`).removeClass('fa fa-spinner loading');
      }, 7800); 
    }

    $('#acceptRequirement').on('click',()=>{
      $(this).each(function () { 
        this.checked = !this.checked;

        if(this.checked == true){
          $("#submitKarya").prop("disabled", false);
        } else {
          $("#submitKarya").prop("disabled", true);
        }
      });
    })

    
    $('#submitKarya').on('click',()=>{
      addLoading('#submitKarya');
    })
  </script>
    
@endsection