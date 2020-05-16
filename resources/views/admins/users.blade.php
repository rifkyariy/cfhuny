<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Website Internal Gemastik - Admin Dashboard</title>
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
            <img src="{{asset('img/brand/logo-infinite.png')}}" class="navbar-brand-img" alt="Logo Infinite">
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
                <a class="nav-link" href="{{ route('teams.index') }}">
                  <i class="ni ni-chat-round text-primary"></i>
                    <span class="nav-link-text">Undangan Tim</span>
                </a>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('teams.index') }}">
                  <i class="ni ni-chat-round text-primary"></i>
                    <span class="nav-link-text">Tim</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('users.index') }}">
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
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Pengguna</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
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
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Pengguna</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <!-- <th scope="col" class="sort" data-sort="no">No</th> -->
                    <th scope="col" class="sort" data-sort="name">Nama</th>
                    <th scope="col" class="sort" data-sort="budget">Role</th>
                    <th scope="col" class="sort" data-sort="status">NIM</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="sort">No Telepon</th>
                    <th scope="col" class="sort" data-sort="completion">Program Studi</th>
                    <th scope="col" class="sort">Kartu Mahasiswa</th>
                    <th scope="col" class="sort">Ubah</th>
                    <th scope="col" class="sort">Hapus</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($users as $user)
                  <tr>
                    <!-- <td scope="row">
                      <div class="media-body">
                      <span class="name mb-0 text-sm">{{ $no++ }}</span>                    
                      </div>
                    </td> -->
                    <th scope="row">
                      <div class="media-body">
                      <span class="name mb-0 text-sm">{{ $user->name }}</span>                    
                      </div>
                    </th>
                    <td>
                        @if($user->role == "Admin")
                          <h3>
                          <span class="badge badge-success">
                            {{ $user->role}}
                          </span>
                          </h3>
                        @elseif($user->role == "Reviewer")
                          <h3>
                          <span class="badge badge-secondary">
                            {{ $user->role}}
                          </span>
                          </h3>
                        @elseif($user->role == "Dosen")
                          <h3>
                          <span class="badge badge-warning">
                            {{ $user->role}}
                          </span>
                          </h3>
                        @else
                            <h3>
                            <span class="badge badge-info">
                                {{ $user->role}}
                            </span>
                            </h3>                            
                        @endif
                      </span>
                    </td>
                    <td>
                      <div class="media-body">
                      @if($user->nim)
                        <span class="name mb-0 text-sm">{{ $user->nim }}</span>
                      @else
                      <span class="name mb-0 text-sm">Tidak ada</span>
                      @endif
                      </div>
                    </td>
                    <td>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ $user->email }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="media-body">
                      @if($user->phone)
                        <span class="name mb-0 text-sm">{{ $user->phone }}</span>
                      @else
                      <span class="name mb-0 text-sm">Tidak ada</span>
                      @endif
                      </div>
                    </td>
                    <td>
                      <div class="media-body">
                      @if($user->prodi)
                        <span class="name mb-0 text-sm">{{ $user->prodi }}</span>
                      @else
                      <span class="name mb-0 text-sm">Tidak ada</span>
                      @endif
                      </div>
                    </td>
                    <td>
                        @if($user->ktm)
                            <a href="{{ route('users.download', [$user->id]) }}" class="btn btn-info btn-sm">Download</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', [$user->id])}}" class="btn btn-success btn-sm">Ubah</a>
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal-{{ $user->id }}">
                          Hapus
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{ $user->id }}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel-{{ $user->id }}">Peringatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h3>Anda yakin ingin menghapus user ini?</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{ route('users.destroy', [$user->id]) }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>                                
                              </div>
                            </div>
                          </div>
                        </div>                      
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
                {{ $users->links() }}
              </nav>
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