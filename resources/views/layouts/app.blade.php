<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UNY National Cartesion</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('img/brand/favicon.ico') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('css/argon.css?v=1.2.0')}}" type="text/css">
  
  <!-- Extension CSS -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
  <link href="{{asset('css/extension/select2.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/extension/sweetalert2.min.css')}}">
</head>

<body>
    
  @yield('content')

  <!-- Argon Scripts -->
  <!-- Core -->
  <!--<script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
  
  <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{asset('vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('js/argon.js?v=1.2.0')}}"></script>
  
  <!-- Extension JS-->
  <script src="{{asset('js/extension/select2.min.js')}}"></script>
  <script src="{{asset('js/extension/sweetalert2.min.js')}}"></script>

  @yield('localjs')
</body>

</html>
