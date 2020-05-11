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
                  <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Dashboard</a></li>
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
     <div class="col-xl-3 order-xl-2">
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
                  {{ $pt->name ?? 'Profil Belum Dilengkapi' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-9 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit Tim</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('teams.update', [$team->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <h6 class="heading-small text-muted mb-4">Informasi tim</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nama Tim</label>
                      <input type="text" name="name" id="input-username" class="form-control {{ $errors->first('name') ? 'is-invalid' : ''}}" placeholder="Nama Tim" value="{{$team->name}}" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Cabang Lomba</label> <br>
                        <input id="cabang_lomba" name="cabang_lomba" type="hidden" value="{{$team->cabang_lomba}}">
                        <select  id="input-cabang-lomba" class="form-control {{ $errors->first('cabang_lomba') ? 'is-invalid' : ''}}" name="" required>
                          @if ($team->cabang_lomba!=null)
                            <option value="{{$cabangLomba->id}}">{{$cabangLomba->name}}</option>
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
                <h6 class="heading-small text-muted mb-4">Anggota tim</h6>
                <div class="pl-lg-4 anggotatim">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="anggota-con">
                        @foreach ($members as $key => $member)
                        <div class="form-group fg-anggota" id="{{$key == 0? 'Ketua' : 'anggota'.$key}}">
                          <label class="anggota-title form-control-label {{ $errors->first('anggota${[anggota]}') ? 'is-invalid' : ''}}" for="input-address">{{$key == 0? 'Ketua' : 'Anggota '.$key}}</label> 
                          @if ($key != 0)
                            <input type="hidden" name="anggota_id[]" id="input-username" class="form-control {{ $errors->first('anggota_id[]') ? 'is-invalid' : ''}}"  value="{{$member->id}}">    
                            <a ><span onclick="hapusAnggota({{'anggota'.$key}})" class=" ml-2 badge badge-pill badge-danger my-1">Hapus Anggota</span></a>
                          @endif
                          <br>
                          <h6 class="heading-small text-muted mb-4">Informasi {{$key == 0? 'Ketua' : 'Anggota'}}</h6>
                          <div class="pl-lg-4">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-username">Nama Lengkap</label>
                                <input type="text" name="anggota_name[]" id="input-username" class="form-control {{ $errors->first('anggota_name[]') ? 'is-invalid' : ''}}" placeholder="Nama Lengkap" value="{{$member->name}}" {{$key==0?'disabled':''}}  required>
                                  <div class="invalid-feedback">
                                      {{ $errors->first('name') }}
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-email">Alamat Email</label>
                                  <input type="email" name="anggota_email[]" id="input-email" placeholder="Alamat Email" class="form-control {{ $errors->first('anggota_email[]') ? 'is-invalid' : ''}}" value="{{$member->email}}" {{$key==0?'disabled':''}} >
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-university">Universitas</label>
                                    <input id="input-university-id" name="anggota_university_id[]" type="hidden" value="{{ Auth::user()->university_id }}">
                                    <select class="form-control input-university" id="input-university">
                                      @if ($pt!=null)
                                        <option value="{{$pt->id}}">{{$pt->name}}</option>
                                      @endif
                                    </select>
                                    <div class="invalid-feedback">
                                      {{ $errors->first('anggota_university_id${[anggota]}') }}
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-address">Program Studi</label>
                                    <input id="input-address" name="anggota_prodi[]" class="form-control {{ $errors->first('anggota_prodi[]') ? 'is-invalid' : ''}}" placeholder="Program Studi" type="text" value="{{$member->prodi}}" {{$key==0?'disabled':''}} required>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('anggota_prodi${[anggota]}') }}
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-address">NIM</label>
                                    <input id="input-address" name="anggota_nim[]" class="form-control {{ $errors->first('anggota_nim[]') ? 'is-invalid' : ''}}" placeholder="Nomor Induk Mahasiswa" type="text" value="{{$member->nim}}" {{$key==0?'disabled':''}} required>
                                    <div class="invalid-feedback">
                                      {{ $errors->first('anggota_nim${[anggota]}') }}
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="input-username">No Hp</label>
                                    <input type="text" name="anggota_phone[]" id="input-username" class="form-control {{ $errors->first('anggota_phone[]') ? 'is-invalid' : ''}}" value="{{$member->phone}}" placeholder="No Hp" {{$key==0?'disabled':''}} required>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('anggota_phone${[anggota]}') }}
                                    </div>
                                  </div>
                              </div>
                            </div>
                            @if ($key == 0)
                              <label ><b>* Anda tidak bisa mengubah informasi Ketua disini, Anda bisa mengubah melalui menu <a href="{{url('profile')}}">Profil</a>. </b></label>
                            @endif
                          </div>
                          <hr class="my-4" />
                          <!-- Address -->
                          @if ($key!=null)
                            <h6 class="heading-small text-muted mb-4">Upload Berkas Persyaratan</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group ">
                                    <label class="form-control-label" for="input-email">Foto Kartu Tanda Mahasiswa</label>
                                    <div class="ktmform{{$key}}">
                            
                                    @if ($member->ktm != null)
                                      <a class="btn btn-cl-white btn-form btn-warning" id="downloadKTM" onclick="downloadKTM(this,{{$key}},'{{$member->ktm}}')">  Download KTM</a>
                                      <a class="btn btn-cl-white btn-form btn-success" id="reuploadKTM" onclick="reuploadKTM({{$key}},'{{$member->ktm}}')">Upload Ulang</a>
                                    @else  
                                      <input type="file" name="anggota_ktm[]" class="form-control {{ $errors->first('anggota_ktm${[anggota]}') ? 'is-invalid' : ''}}" required>  
                                      <br>
                                      <h5>File harus berformat jpg atau png</h5>
                                      <h5>Ukuran maksimal 4MB</h5>  
                                    @endif
                                        
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('anggota_ktm${[anggota]}') }}
                                    </div>
                                  </div>
                                </div>
                              </div>             
                            </div>
                            <div class="invalid-feedback">
                              {{ $errors->first('anggota${[anggota]}') }}
                            </div>
                          @endif
                        </div>
                        @endforeach
                      </div>

                      <a class="btn-cl-white btn btn-form btn-success" id="tambahAnggota" onclick="tambahAnggota()">Tambah Anggota</a><br><br>
                    </div>
                  </div>           
                </div>

                <input id="jumlah_anggota" name="jumlah_anggota" type="hidden">
                <input id="anggota_ganti_ktm" name="anggota_ganti_ktm" type="hidden">
                <hr class="my-4" />
                <div class="pl-lg-4">
                    <button type="submit" id="buatTim" class="btn btn-primary" >Update Perubahan</button>
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
  <script>
    let anggota = {{$memberCount}};

    $(document).ready(function() {
      // initiate select2
      $('#input-cabang-lomba').select2({
        ajax: {
          url: '{{url("/api/sel2/cabanglomba")}}',
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
        placeholder: 'Pilih Cabang Lomba'
      });

      // init state
      // disable univeristas select
      $('.input-university').select2();
      $('.input-university').prop("disabled", true);

      // adding jumlah anggota
      $('#jumlah_anggota').val(anggota);

      // hide tambah anggota button when anggota == 2
      if (anggota == 2){
        $('#tambahAnggota').hide();
      }

    });

    // select2 onchange trigger
    $('#input-cabang-lomba').on('change',() => {
      let id = $('#input-cabang-lomba :selected').val();
      $('#cabang_lomba').val(id) ;
    })

    // fungsi untuk tambah anggota
    let tambahAnggota = () => {
      // html component
      if (anggota<=2) {
        $('.anggota-con').append(` 
        <div class="form-group fg-anggota" id="anggota${anggota+1}">
          <label class="anggota-title form-control-label {{ $errors->first('anggota${[anggota]}') ? 'is-invalid' : ''}}" for="input-address">Anggota  ${anggota+1}</label> 
          <a ><span onclick="hapusAnggota(${anggota+1})" class=" ml-2 badge badge-pill badge-danger my-1">Hapus Anggota</span></a>
          <br>
          <h6 class="heading-small text-muted mb-4">Informasi Anggota</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-username">Nama Lengkap</label>
                  <input type="text" name="anggota_name[]" id="input-username" class="form-control {{ $errors->first('anggota_name${[anggota]}') ? 'is-invalid' : ''}}" placeholder="Nama Lengkap"  required>
                  <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Alamat Email</label>
                  <input type="email" name="anggota_email[]" id="input-email" placeholder="Alamat Email" class="form-control {{ $errors->first('anggota_email${[anggota]}') ? 'is-invalid' : ''}}"  >
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-university">Universitas</label>
                    <input id="input-university-id" name="anggota_university_id[]" type="hidden" value="{{ Auth::user()->university_id }}">
                    <select class="form-control input-university" id="input-university">
                      @if ($pt!=null)
                        <option value="{{$pt->id}}">{{$pt->name}}</option>
                      @endif
                    </select>
                    <div class="invalid-feedback">
                      {{ $errors->first('anggota_university_id${[anggota]}') }}
                    </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-address">Program Studi</label>
                    <input id="input-address" name="anggota_prodi[]" class="form-control {{ $errors->first('anggota_prodi${[anggota]}') ? 'is-invalid' : ''}}" placeholder="Program Studi" type="text" value="" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('anggota_prodi${[anggota]}') }}
                    </div>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-address">NIM</label>
                    <input id="input-address" name="anggota_nim[]" class="form-control {{ $errors->first('anggota_nim${[anggota]}') ? 'is-invalid' : ''}}" placeholder="Nomor Induk Mahasiswa" type="text" value="" required>
                    <div class="invalid-feedback">
                      {{ $errors->first('anggota_nim${[anggota]}') }}
                    </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">No Hp</label>
                    <input type="text" name="anggota_phone[]" id="input-username" class="form-control {{ $errors->first('anggota_phone${[anggota]}') ? 'is-invalid' : ''}}" value="" placeholder="No Hp" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('anggota_phone${[anggota]}') }}
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <hr class="my-4" />
          <!-- Address -->
          <h6 class="heading-small text-muted mb-4">Upload Berkas Persyaratan</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group ">
                  <label class="form-control-label" for="input-email">Foto Kartu Tanda Mahasiswa</label>
                  <div class="ktmform">
                      <input type="file" name="anggota_ktm[]" class="form-control {{ $errors->first('anggota_ktm${[anggota]}') ? 'is-invalid' : ''}}" required>  
                      <br>
                      <h5>File harus berformat jpg atau png</h5>
                      <h5>Ukuran maksimal 4MB</h5>
                  </div>
                  <div class="invalid-feedback">
                      {{ $errors->first('anggota_ktm${[anggota]}') }}
                  </div>
                </div>
              </div>
            </div>             
          </div>
          <div class="invalid-feedback">
            {{ $errors->first('anggota${[anggota]}') }}
          </div>
        </div>
        `);

        anggota++;
        $('#jumlah_anggota').val(anggota);

      }
      
      // hide tambah anggota button when anggota == 2
      if (anggota == 2){
        $('#tambahAnggota').hide();
      }
      
      // disable univeristas select
      $('.input-university').select2();
      $('.input-university').prop("disabled", true);
    }

    // fungsi untuk hapus anggota (tampil alert)
    let removeMember = (link) => {
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Anda tidak bisa mengembalikan lagi !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2F59EC',
        cancelButtonColor: '#f5365c',
        confirmButtonText: 'Ya, Hapus Member'
      }).then((result) => {
          window.location = link;
      })
    }

    // real fungsi untuk hapus anggota
    let hapusAnggota = (anggotaId) => {
      
      // change other form anggota when exist
      $(`#anggota${anggotaId}`).remove();
      $('.fg-anggota').attr("id",`anggota1`);
      $('.fg-anggota .anggota-title').text(`Anggota 1`);
      $(".fg-anggota .badge").attr("onclick",`hapusAnggota(1)`);
      anggota--;

      // mengupdate jumlah anggota
      $('#jumlah_anggota').val(anggota);

      // show tambah anggota button when anggota < 2
      if(anggota < 2){
        $('#tambahAnggota').show();
      }
    }

    
    // add loading spinner
    let = addLoading = (selector) => {
      $(selector).prepend('<i class="fa fa-spinner loading"></i>');

      setTimeout(function() {
        $(`${selector} i`).removeClass('fa fa-spinner loading');
      }, 5800); 
    }

    // download KTM 
    let downloadKTM = (clickedEl,member,file) => {
      addLoading(clickedEl);
      if(member!=0){
        window.location = `/api/file/ktm?filename=${file}`;
      }

    };

    // reupload KTM
    let reuploadKTM = (key,file) => {
      $(`.ktmform${key}`).html(`
        <div class="row">
          <div class="col-lg-9">
            <input type="file" name="anggota_ktm[]" class="form-control {{ $errors->first('ktm') ? 'is-invalid' : ''}}" required>  
            <br>
            <h5>File harus berformat jpg atau png</h5>
            <h5>Ukuran maksimal 4MB</h5>
          </div>
          <div class="col-lg-3">
            <a class="btn btn-cl-white btn-form btn-danger" id="batalReupload" onclick="batalReupload(${key},'${file}')">Batal</a>
          </div>
        <div>
      `);
      $('#anggota_ganti_ktm').val(key);
    };

    let batalReupload = (key,file) => {
      $(`.ktmform${key}`).html(`
        <a class="btn btn-cl-white btn-form btn-warning" id="downloadKTM" onclick="downloadKTM(this,${key},'${file}')">  Download KTM</a>
        <a class="btn btn-cl-white btn-form btn-success" id="reuploadKTM" onclick="reuploadKTM(${key},'${file}')">Upload Ulang</a>
      `);
    };
  </script>
@endsection