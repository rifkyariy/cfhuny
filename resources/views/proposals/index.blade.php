<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Website Internal Gemastik - User Dashboard</title>
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
              <h6 class="h2 text-white d-inline-block mb-0">Proposal</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                  @if(Auth::user()->role != "Mahasiswa")
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                  @else
                    <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Dashboard</a></li>
                  @endif
                  <li class="breadcrumb-item"><a href="{{ route('teams.show', [$teamId]) }}">Tim</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Proposal</li>
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
              <h3 class="mb-0">Proposal Tim</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="status">Judul</th>
                    <th scope="col">Tahap</th>
                    <th scope="col" class="sort">Cabang Lomba</th>
                    <th scope="col" class="sort" data-sort="completion">Status Proposal</th>
                    <th scope="col" class="sort">Ulasan</th>
                    <th scope="col" class="sort">Download Proposal</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($proposals as $proposal)
                  <tr>
                    <th scope="row">
                      <div class="media-body">
                        {{ $proposal->judul }}
                      </div>
                    </th>

                    <td>
                      <div class="media-body">
                        @if($proposal->tahap == 6)
                          <span class="name mb-0 text-sm">Proposal Lengkap</span>
                        @elseif($proposal->tahap == 5)
                          <span class="name mb-0 text-sm">Bab 4</span>
                        @elseif($proposal->tahap == 4)
                          <span class="name mb-0 text-sm">Bab 3</span>
                        @elseif($proposal->tahap == 3)
                          <span class="name mb-0 text-sm">Bab 2</span>
                        @elseif($proposal->tahap == 2)
                          <span class="name mb-0 text-sm">Bab 1</span>
                        @else
                          <span class="name mb-0 text-sm">Abstrak</span>
                        @endif
                      </div>
                    </td>
                    <td>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ $proposal->team->cabang_lomba }}</span>
                      </div>
                    </td>
                    <td>
                        @if($proposal->status == "Menunggu Review")
                          <h3>
                          <span class="badge badge-info">
                            Menunggu Review
                          </span>
                          </h3>
                        @elseif($proposal->status == "Disetujui")
                          <h3>
                          <span class="badge badge-success">
                            Disetujui
                          </span>
                          </h3>
                        @else
                          <h3>
                          <span class="badge badge-danger">
                            Ditolak
                          </span>
                          </h3>
                        @endif
                      </span>
                    </td>
                    <td>
                      <div class="media-body">
                      @if($proposal->status == "Menunggu Review")
                        <span class="name mb-0 text-sm">Belum ada ulasan</span>
                      @endif
                        <span class="name mb-0 text-sm">{{ $proposal->ulasan }}</span>
                      </div>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('proposals.download', [$proposal->team->id,$proposal->id]) }}">Download Proposal</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
              @if(Auth::user()->role == "Mahasiswa")
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#approvedModal" >Upload Proposal</button>
                <div class="modal fade" id="approvedModal" role="dialog" aria-labelledby="approvedModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approvedModalLabel">Upload Proposal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method=POST action="{{ route('proposals.store', [$teamId]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="message-text" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Tahap</label>
                            <select name="tahap" class="form-control" required>
                            @if($nextTahap == 6)
                                <option value="1">Abstrak</option>
                                <option value="2">Bab 1</option>
                                <option value="3">Bab 2</option>
                                <option value="4">Bab 3</option>
                                <option value="5">Bab 4</option>
                                <option value="6">Proposal lengkap</option>                            
                            @elseif($nextTahap == 5)
                                <option value="1">Abstrak</option>
                                <option value="2">Bab 1</option>
                                <option value="3">Bab 2</option>
                                <option value="4">Bab 3</option>
                                <option value="5">Bab 4</option>
                            @elseif($nextTahap == 4)
                                <option value="1">Abstrak</option>
                                <option value="2">Bab 1</option>
                                <option value="3">Bab 2</option>
                                <option value="4">Bab 3</option>
                            @elseif($nextTahap == 3)
                                <option value="1">Abstrak</option>
                                <option value="2">Bab 1</option>
                                <option value="3">Bab 2</option>  
                            @elseif($nextTahap == 2)
                                <option value="1">Abstrak</option>
                                <option value="2">Bab 1</option>                                      
                            @else
                                <option value="1">Abstrak</option>
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">File Proposal</label>
                            <input type="file" class="form-control" name="proposal" required> <br>
                            <h5>File harus bertipe pdf<br>
                            Ukuran maksimal 4MB</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>          
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
                @endif
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