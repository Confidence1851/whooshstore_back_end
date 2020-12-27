<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
  <!-- plugin css -->
  <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
  <!-- end plugin css -->
  <link href="toastr.css" rel="stylesheet"/>

  @stack('plugin-styles')

  <!-- common css -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
   @toastr_css
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}" class="loaded nimbus-is-editor sidebar-dark">
<script src="{{asset('assets/js/spinner.js')}}"></script>


  <div class="main-wrapper" id="app">
    @include('admin.layout.sidebar')
    <div class="page-wrapper">
      @include('admin.layout.header')
      <div class="page-content">
        @yield('content')
      </div>
      @include('admin.layout.footer')
    </div>
  </div>

    <!-- base js -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('assets/plugins/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!--other js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script> 
    
    <script> 
      $('.colorpicker').colorpicker();
    </script>
    <!-- end other js-->
    
    <!-- common js -->
    <script src="{{asset('assets/js/template.js')}}"></script>
    <!-- end common js -->
    
    @stack('custom-scripts')
    @stack('other-scripts')
    {{--  toastr  --}}
   
</body>
    @jquery
    @toastr_js
    @toastr_render
</html>