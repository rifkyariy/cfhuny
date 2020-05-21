
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
              <h6 class="h2 text-white d-inline-block mb-0">Anggota Tim</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                  @if(Auth::user()->role != "Mahasiswa")
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                  @else
                    <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Dashboard</a></li>
                  @endif
                  <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Tim</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <span class="badge badge-pill badge-info mb-1">{{ $cabanglomba->name }}</span>
              <h2 class="mt-1"><b>{{ $team->name }}</b></h2>
              <h4 class="mb-0">{{ $pt->name }}</h4>
              <br>
              <nav class="" aria-label="...">
              @if(Auth::user()->role == "Mahasiswa")
                <a href="{{ route('teams.edit', [$team->id])}}" class="btn-cl-white btn btn-primary">Edit Tim</a> 
                <a id="hapusTim" onclick="removeTeam('{{ route('teams.destroy', [$team->id])}}')" class="btn-cl-white btn btn-danger">Hapus Tim</a> 
                {{-- <a href="{{ route('teams.edit', [$team->id])}}" class="btn-cl-white btn btn-success">Download Sertifikat</a>  --}}
                @if ($subs!=null)
                  <a href="{{ route('submissions.edit', [$subs->id,$team->id]) }}" class="btn btn-warning">Submission</a>  
                @else
                  <a href="{{ route('submissions.create', [$team->id]) }}" class="btn btn-warning">Submission</a>  
                @endif
              @endif
              </nav>
              <br>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" >Nama Anggota</th>
                    <th scope="col" class="sort" >Program Studi</th>
                    <th scope="col">Jabatan</th>
                    @if(Auth::user()->role == "Mahasiswa")
                    {{-- <th scope="col" class="sort">Proposal Tim</th> --}}
                    @endif
                    <th scope="col" class="sort" >Aksi</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($team->members as $key => $member)
                  <tr>
                    <th scope="row">
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ $member->name }}</span>
                      </div>
                    </th>
                    <td>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ $member->prodi }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ $member->pivot->role == 'Anggota'? $member->pivot->role.' '.$key++:'Ketua' }}</span>
                      </div>
                    </td>
                    @if(Auth::user()->role == "Mahasiswa")
                      {{-- <td>
                        <a href="{{ route('proposals.index', [$team->id]) }}" class="btn btn-info btn-sm">Lihat Proposal</a>
                      </td> --}}
                    @endif
                      <td>
                        <a onclick="removeMember('{{ route('teams.removemember', [$team->id,$member->id])}}')" class="btn-cl-white remove-member btn btn-danger btn-sm {{$member->user_id==Auth::user()->id?'disabled':''}}" {{$member->user_id==Auth::user()->id?'disabled':''}}>Hapus</a> 
                        {{-- <a href="{{ route('teams.edit', [$team->id])}}" class="btn-cl-white btn btn-success btn-sm ">Download Sertifikat</a>  --}}
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- Card footer -->
            <div class="card-footer py-4">
              
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
    let removeMember = (url) => {
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Anda tidak bisa mengembalikan lagi !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2F59EC',
        cancelButtonColor: '#f5365c',
        confirmButtonText: 'Ya, Hapus Member'
      }).then((result) => {
        if (result.value) {
          window.location = url;
        }
      })
    }

    let removeTeam = (url) => {
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Anda tidak bisa mengembalikan lagi !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2F59EC',
        cancelButtonColor: '#f5365c',
        confirmButtonText: 'Ya, Hapus Tim'
      }).then((result) => {
        console.log(result.value);
        if (result.value) {
          $.ajax({
              url: url,
              type: "DELETE", 
              data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
              },
              success: function(result) {
                if(result.status == 200){
                  Swal.fire(
                    'Terhapus!',
                    'Tim {{ $team->name }} berhasil dihapus.',
                    'success'
                  ).then((result) => {
                    window.location = "{{ url('teams')}}";
                  });
                }
              }
          });
        }else{
          event.preventDefault();
        }
      })
    }
  </script>    
@endsection




